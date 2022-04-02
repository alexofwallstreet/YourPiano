<template>
  <SpinnerOverlay :is-loading="isLoading"></SpinnerOverlay>
  <div class="flex bg-indigo-50" :style="{ minHeight: `calc(100vh - ${store.state.uiElements.navbarHeight})`}">
    <!-- Sidebar Start -->
    <div
      class="sidebar flex flex-col relative bg-indigo-900 text-white pb-10"
      :style="{ width: sidebarWidth }">
      <!-- Toggle button with Arrows -->
      <div
        class="collapse-icon right-0 top-10 flex items-center justify-center
      absolute bg-indigo-300 hover:bg-indigo-600 text-white font-bold cursor-pointer rounded-r-2xl"
        @click="toggleSidebar">
        <div class="arrow-container" :class="{'open': !collapsed}">
          <div class="arrow bg-indigo-900"></div>
          <div class="arrow bg-indigo-600"></div>
          <div class="arrow bg-indigo-300"></div>
        </div>
      </div>
      <div class="menu px-2 pt-5" :class="{'menu-visible': collapsed}">
        <!-- End Toggle button with Arrows -->
        <div class="song-wrapper" v-if="!isFreePlayMode()">
          <div class="max-w-sm rounded-xl overflow-hidden shadow-lg w-full h-52">
            <img class="w-full h-full object-cover" src="/images/banner.jpg" alt="Sunset in the mountains">
          </div>
          <div class="pt-4">
            <div class="font-bold text-sm text-blue-200 whitespace-nowrap">Неизвестный</div>
            <div class="font-bold text-xl mb-2 whitespace-nowrap">Без названия</div>
          </div>
          <!-- Slider -->
          <div class="w-full h-2 bg-indigo-400 dark:bg-gray-700 rounded my-2">
            <div class="h-full bg-white song-slider rounded"
                 :style="{ width: lastNoteTime > playTime ? (playTime / lastNoteTime * 100 + '%') : ('100%') }"></div>
          </div>

          <div class="pb-2 flex justify-start">
            <svg
              v-on:click.prevent="playSong"
              xmlns="http://www.w3.org/2000/svg"
              class="song-control-btn h-10 w-10 cursor-pointer relative" viewBox="0 0 20 20"
              :class="{'fill-indigo-400' : isPlaying() || isCountdown(), 'fill-white' : !isPlaying() && !isCountdown()}">
              <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                    clip-rule="evenodd"/>
            </svg>
            <svg v-on:click.prevent="pauseSong" xmlns="http://www.w3.org/2000/svg"
                 class="song-control-btn h-10 w-10 cursor-pointer relative" viewBox="0 0 20 20" fill="currentColor"
                 :class="{'fill-white' : isPlaying() && !isCountdown() ,
                    'fill-indigo-400' : !isPlaying() || isCountdown()}">
              <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"/>
            </svg>
            <svg v-on:click.prevent="stopSong" xmlns="http://www.w3.org/2000/svg"
                 class="song-control-btn h-10 w-10 cursor-pointer relative" viewBox="0 0 20 20"
                 :class="{'fill-white' : isPlaying() && !isCountdown() ,
                    'fill-indigo-400' : !isPlaying() || isCountdown()}">
              <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z"
                    clip-rule="evenodd"/>
            </svg>
            <div class="flex justify-end ml-auto">
              <svg xmlns="http://www.w3.org/2000/svg" class="song-control-btn h-10 w-10 cursor-pointer relative" viewBox="0 0 20 20"
                   fill="currentColor"
                   :class="{'fill-indigo-400' : isPlaying() && !isCountdown() ,
                    'fill-red-400' : !isPlaying() || isCountdown()}">>
                <path fill-rule="evenodd"
                      d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                      clip-rule="evenodd"/>
              </svg>
            </div>
          </div>

          <div class="w-full" v-if="isTutorialMode()">
            <label for="speed" class="font-bold text-white whitespace-nowrap">Скорость: {{ songSpeed }}</label>
            <input type="range" id="speed" name="range" min="0" max="2" step="0.01"
                   class="w-full h-2 bg-indigo-100 appearance-none" v-model="songSpeed"/>
          </div>
        </div>


        <!-- MIDI Instrument select -->
        <div class="col-span-6 sm:col-span-3 mt-2" v-if="isFreePlayMode()">
          <label for="instrument" class="block text-sm font-medium text-white whitespace-nowrap">Инструмент</label>
          <select id="instrument" name="instrument" autocomplete="instrument-name" v-model="selectedMidiInstrument"
                  @change="onInstrumentChange"
                  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-indigo-600 font-bold rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option class="text-indigo-600 font-bold" v-for="instrument in midiInstruments" v-bind:value="instrument">{{
                instrument
              }}
            </option>
          </select>
        </div>

        <!-- MIDI Device select -->
        <div class="col-span-6 sm:col-span-3 mt-2">
          <label for="device" class="block text-sm font-medium text-white whitespace-nowrap">MIDI Устройство</label>
          <select id="device" name="device" autocomplete="Выберите устройство"
                  @change="midiDeviceSelected = $event.target.value"
                  v-bind:disabled="midiDevices.devices.length === 0"
                  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-indigo-600 font-bold rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option class="text-indigo-600 font-bold" selected disabled hidden>
              {{ midiDevices.devices.length === 0 ? 'Нет доступных' : 'Выберите устройство' }}
            </option>
            <option class="text-indigo-600 font-bold" v-for="device in midiDevices.devices" v-bind:key="device.id"
                    v-bind:value="device.name">{{
                device.name
              }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <!-- Sidebar End -->

    <div class="flex-1 overflow-auto">
      <div className="main flex lg:justify-center md:justify-start w-full">
        <!-- Piano Keyboard + Falling Notes -->
        <div className="content flex flex-col justify-between h-full">
          <div className="flex h-full">
            <div className="notesColumns" ref="notesColumns">
              <div className="flex h-full">
                <div
                  class="bg-gray-700"
                  v-for="(column, cindex) in notesColumns"
                  v-bind:key="`notesColumn_${cindex}`"
                  v-bind:class="{
                notesColumn: !column.isNarrow,
                narrowNotesColumn: column.isNarrow,
              }"
                  v-bind:style="{ 'margin-left': getMarginLeftNotesColumn(cindex) }"
                >
                  <div
                    class="note bg-blue-500 border-2 rounded-lg"
                    v-for="(time, nindex) in column.visibleNotes"
                    v-bind:key="`note_${cindex}_${nindex}`"
                    v-bind:style="{ top: getScreenYPosByTime(time) }"
                  />
                  <div className="dropArea"/>
                </div>
              </div>
            </div>
          </div>
          <div className="keyboard flex pb-3">
            <div
              v-for="(key, index) in keys"
              v-bind:key="key[0] + key[1]"
              v-bind:class="{
            whiteKey: isWhiteKey(key[0]),
            blackKey: !isWhiteKey(key[0]),
            pressed: isKeyPressed(key[0], key[1]),
          }"
              v-bind:style="{ 'margin-left': getMarginLeftNotesColumn(index) }"
              v-on:mousedown="playNote(key[0], key[1])"
            >
              <div className="keySign text-center">{{ getKeySign(key[0], key[1]) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from "../store";
import MidiDevices from "../piano/midi_devices";
import MidiFile from "../piano/midi_file";
import {ref, computed} from 'vue'
import Soundfont from "soundfont-player";
import Sidebar from "./ui/Sidebar.vue";
import KEYBOARD_NOTES from '../piano/notes';
import INSTRUMENTS from '../piano/instruments';
import SpinnerOverlay from "./ui/SpinnerOverlay.vue";

const BLACK_KEY_WIDTH = 22;
const NOTE_HEIGHT = 38;
const VISIBILITY_RANGE = 5; // seconds
const OCTAVE_BASE = 3;
//const OCTAVE_MAX = 5;
const NOTE_EXTRA_TIME = 0.3; // seconds = extra time before note is computed as missing
const MIDI_VALUE_C2 = 36;
const NOTES = ["C", "C#", "D", "D#", "E", "F", "F#", "G", "G#", "A", "A#", "B"];


const COUNTDOWN_TIME = 3; // seconds
const GAME_STATE = {
  idle: 1,
  countdown: 2,
  playing: 3,
  paused: 4,
};

export default {
  name: "Keyboard",
  data: function () {
    const keys = [];

    const keyboardValues = Object.values(KEYBOARD_NOTES);
    keyboardValues.sort((a, b) => {
      return a.id - b.id;
    });

    keyboardValues.forEach((key) => {
      keys.push([key.note, key.octave]);
    });

    let notesColumns = [];

    let isLoading = true;

    for (let k of keys) {
      notesColumns.push({
        isNarrow: !this.isWhiteKey(k[0]),
        notes: [],
        visibleNotes: [],
        startNotesIdx: 0,
      });
    }

    return {
      store,
      isLoading: isLoading,
      states: GAME_STATE,
      gameState: GAME_STATE.idle,
      keys: keys,
      keysPressed: {},
      notesColumns: notesColumns,
      prevGameState: null,
      midiFile: null,
      midiDevices: new MidiDevices(this.onDeviceKeyDown, this.onDeviceKeyUp),
      midiDeviceSelected: null,
      songSpeed: 1,
      inPianolaMode: false,
      stats: {
        perfect: 0,
        good: 0,
        bad: 0,
      },
      midiInstruments: INSTRUMENTS,
      selectedMidiInstrument: INSTRUMENTS[2],
      totalSongNotes: null,
      currentSongNote: null,
      playTime: 0,
      prevPlayTime: 0,
      lastNoteTime: 0
    };
  },
  async mounted() {
    window.addEventListener("keydown", this.onKeyDown);
    window.addEventListener("keyup", this.onKeyUp);

    this.start = Date.now();
    this.playTime = 0;
    this.prevPlayTime = 0;
    this.animFrameId = window.requestAnimationFrame(this.tick);
    await this.initAudio();
    this.loadingComplete();
    this.loadFurElise();
  },
  unmounted: function () {
    if (this.animFrameId) {
      window.cancelAnimationFrame(this.animFrameId);
    }
    window.removeEventListener("keyup", this.onKeyUp);
    window.removeEventListener("keydown", this.onKeyDown);
    this.unsetAudio();
  },
  methods: {
    tick: function () {
      const current = Date.now();
      const delta = ((current - this.start) / 1000) * this.songSpeed;

      this.start = current;
      switch (this.gameState) {
        case GAME_STATE.countdown:
          this.computeNotesState();
          this.playTime += delta;
          this.timer -= delta;

          if (this.timer <= 3) {
            this.setGameState(GAME_STATE.playing);
          }
          break;

        case GAME_STATE.playing:
          this.computeNotesState();
          this.computeMissingNotes();

          // if (this.inPianolaMode) {
          const self = this;
          for (const column of this.notesColumns) {
            for (const note of column.notes) {
              if (
                this.playTime >= note.time &&
                note.time > this.prevPlayTime
              ) {
                if (!note.processed) {
                  this.onNoteOn(note.note, note.octave);
                  setTimeout(() => self.onNoteOff(note.note, note.octave), 200);
                }
                this.currentSongNote++;
              }
            }
          }

          // }

          this.prevPlayTime = this.playTime;
          this.playTime += delta;

          if (this.playTime > this.lastNoteTime + NOTE_EXTRA_TIME + 1) {
            this.stopSong();
            //END OF SONG
          }
          break;
      }

      this.animFrameId = window.requestAnimationFrame(this.tick);
    },
    async initAudio() {
      this.loadingStart();
      console.log('Loading start...')
      this.audioContext = new window.AudioContext();
      this.soundfont = await Soundfont.instrument(
        this.audioContext, this.selectedMidiInstrument
      ).then(function (instrument) {
        return instrument;
      }).finally(function () {
        console.log('Loading complete');
      });
      this.loadingComplete();
    },
    unsetAudio: function () {
      this.audioContext.close();
    },
    async onInstrumentChange(newInstrument) {
      this.selectedMidiInstrument = newInstrument.target.value;
      await this.initAudio();
    },
    isWhiteKey: function (note) {
      return note.length === 1;
    },
    isKeyPressed: function (note, octave) {
      return this.keysPressed[this.getNoteId(note, octave)];
    },
    loadingStart: function () {
      this.isLoading = true;
    },
    loadingComplete: function () {
      this.isLoading = false;
    },
    playNote(note, octave) {
      this.soundfont.play(`${note}${octave}`, null, {
        duration: 1,
        gain: 2
      });
    },
    onKeyDown: function (event) {
      const key = event.keyCode;
      if (key in KEYBOARD_NOTES) {
        event.preventDefault();
        const noteInfo = KEYBOARD_NOTES[key];
        this.onNoteOn(noteInfo.note, noteInfo.octave);
      }
    },
    onKeyUp: function (event) {
      const key = event.keyCode;
      if (key in KEYBOARD_NOTES) {
        event.preventDefault();
        const noteInfo = KEYBOARD_NOTES[key];
        this.onNoteOff(noteInfo.note, noteInfo.octave);
      }
    },
    onDeviceKeyDown: function (deviceName, midiNote) {
      if (deviceName === this.midiDeviceSelected) {
        const noteInfo = this.convertMidiNote(midiNote);
        this.onNoteOn(noteInfo.note, noteInfo.octave);
      }
    },
    onDeviceKeyUp: function (deviceName, midiNote) {
      if (deviceName === this.midiDeviceSelected) {
        const noteInfo = this.convertMidiNote(midiNote);
        this.onNoteOff(noteInfo.note, noteInfo.octave);
      }
    },
    onNoteOn: function (note, octave) {
      const noteId = this.getNoteId(note, octave);

      if (this.keysPressed[noteId]) {
        return;
      }

      this.playNote(note, octave);

      this.keysPressed[noteId] = true;

      if (this.gameState === GAME_STATE.playing || this.gameState === GAME_STATE.playing && !this.inPianolaMode) {
        const notesColumnIdx =
          (octave - OCTAVE_BASE) * NOTES.length + NOTES.indexOf(note);
        for (const note of this.notesColumns[notesColumnIdx].notes) {
          if (note.processed) {
            continue;
          }
          const diff = Math.abs(note.time - this.playTime);
          if (diff <= 0.5) {
            note.processed = true;
            if (diff < 0.1) {
              ++this.stats.perfect;
            } else {
              ++this.stats.good;
            }
            break;
          }
        }
      }
    },
    onNoteOff: function (note, octave) {
      // Vue.set(this.keysPressed, this.getNoteId(note, octave), false);
      this.keysPressed[this.getNoteId(note, octave)] = false;
    },
    convertMidiNote: function (midiNote) {
      // A piano has 88 keys and ours has 48. We should adjust the note to the octave in the range 2-5 (the note adjust can make the midi song sounds different)
      const noteBase = midiNote - MIDI_VALUE_C2;
      let octave = OCTAVE_BASE + Math.floor(noteBase / 12);
      const noteIdx = noteBase - (octave - OCTAVE_BASE) * 12;

      return {
        note: NOTES[noteIdx],
        noteIdx: noteIdx,
        octave: octave,
      };
    },
    onMidiFileLoaded: function (midiContent) {
      this.midiFile = new MidiFile(midiContent);
      this.totalSongNotes = this.midiFile.events.length;
      this.currentSongNote = 0;
      this.lastNoteTime = 0;

      for (let noteColumn of this.notesColumns) {
        noteColumn.notes = [];
        noteColumn.startNotesIdx = 0;
        //Vue.set(noteColumn, "visibleNotes", []);
        noteColumn["visibleNotes"] = [];
      }

      for (const event of this.midiFile.events) {
        const noteInfo = this.convertMidiNote(event.noteNumber);

        // noteGlobalIdx is the note in the screen piano (idx 0 = first key in the left). It is adjust to the range 0 - piano num keys
        let noteGlobalIdx =
          noteInfo.noteIdx + (noteInfo.octave - OCTAVE_BASE) * 12;

        if (noteGlobalIdx >= this.notesColumns.length) {
          noteGlobalIdx = this.notesColumns.length - 1;
        } else if (noteGlobalIdx < 0) {
          noteGlobalIdx = 0;
        }

        const noteTime = event.time + 3; // 3 seconds before start to play the song

        if (noteTime > this.lastNoteTime) {
          this.lastNoteTime = noteTime;
        }

        this.notesColumns[noteGlobalIdx].notes.push({
          note: noteInfo.note,
          octave: noteInfo.octave,
          time: event.time + 3,
          processed: false, // has been processed as missing, or perfect, etc
        });
      }
    },
    loadFurElise: function () {
      this.stopSong();

      const self = this;
      let request = new XMLHttpRequest();
      const filePath = "/static/fur_elise.mid";
      request.open("GET", filePath, true);
      request.responseType = "arraybuffer";
      request.onload = function () {
        if (request.response) {
          self.onMidiFileLoaded(new Uint8Array(request.response));
        }
      };
      request.send(null);
    },
    loadMidiFile: function (file) {
      this.stopSong();

      const reader = new window.FileReader();
      const self = this;

      reader.onload = function (evt) {
        if (evt.target.readyState === FileReader.DONE) {
          self.onMidiFileLoaded(new Uint8Array(evt.target.result));
        }
      };
      reader.readAsArrayBuffer(file);
    },
    setGameState: function (state) {
      this.prevGameState = this.gameState;
      this.gameState = state;

      switch (state) {
        case GAME_STATE.idle:
          for (const column of this.notesColumns) {
            column.visibleNotes = [];
          }
          break;

        case GAME_STATE.countdown:
          this.timer = COUNTDOWN_TIME;
          this.playTime = 0;
          this.stats = {
            perfect: 0,
            good: 0,
            bad: 0,
          };

          for (const column of this.notesColumns) {
            column.startNotesIdx = 0;

            for (let note of column.notes) {
              note.processed = false;
            }
          }
          break;
      }
    },
    getKeySign: function (note, octave) {
      for (const key in KEYBOARD_NOTES) {
        const mapping = KEYBOARD_NOTES[key];

        if (mapping.note === note && mapping.octave === octave) {
          return mapping.keyCode;
        }
      }

      return "";
    },
    getNoteId: function (note, octave) {
      return `${note}${octave}`;
    },
    getScreenYPosByTime: function (time) {
      return `${
        (1 - (time - this.playTime) / VISIBILITY_RANGE) *
        this.$refs.notesColumns.clientHeight - NOTE_HEIGHT
      }px`;
    },
    getMarginLeftNotesColumn: function (index) {
      if (index === 0) {
        return "0px";
      }

      const column = this.notesColumns[index];
      const prevColumn = this.notesColumns[index - 1];
      if (column.isNarrow || prevColumn.isNarrow) {
        return `${-BLACK_KEY_WIDTH / 2}px`;
      }

      return "0px";
    },
    computeMissingNotes: function () {
      if (this.inPianolaMode) {
        return;
      }

      for (const noteColumns of this.notesColumns) {
        for (const note of noteColumns.notes) {
          if (note.processed) {
            continue;
          }

          if (note.time < this.playTime - NOTE_EXTRA_TIME) {
            ++this.stats.bad;
            note.processed = true;
          }
        }
      }
    },
    computeNotesState: function () {
      const endTime = this.playTime + VISIBILITY_RANGE;

      for (let column of this.notesColumns) {
        column.visibleNotes = [];

        let idx = column.startNotesIdx;
        while (idx < column.notes.length) {
          const time = column.notes[idx].time;

          if (time >= this.playTime) {
            if (time <= endTime) {
              if (!column.notes[idx].processed) {
                column.visibleNotes.push(time);
              }
            } else {
              break; // no more visible notes
            }
          } else if (idx > column.startNotesIdx) {
            column.startNotesIdx = idx;
          }

          ++idx;
        }
      }
    },
    playSong: function () {
      switch (this.gameState) {
        case GAME_STATE.playing:
        case GAME_STATE.countdown:
          return;
        default:
          break;
      }

      switch (this.prevGameState) {
        case GAME_STATE.idle:
        case GAME_STATE.countdown:
          this.setGameState(GAME_STATE.countdown);
          break;
        default:
          this.setGameState(GAME_STATE.playing);
          break;
      }
    },
    pauseSong: function () {
      switch (this.gameState) {
        case GAME_STATE.countdown:
        case GAME_STATE.paused:
          return;
        default:
          this.setGameState(GAME_STATE.paused);
      }
    },
    stopSong: function () {
      this.playTime = 0;
      this.setGameState(GAME_STATE.idle);
      this.prevGameState = GAME_STATE.idle;
    },
    isFreePlayMode: function () {
      return this.gameMode === this.store.state.gameModes.FREE_PLAY_MODE;
    },
    isTutorialMode: function () {
      return this.gameMode === this.store.state.gameModes.TUTORIAL_MODE;
    },
    isRatingPlayMode: function () {
      return this.gameMode === this.store.state.gameModes.RATING_GAME_MODE;
    },
    isPlaying: function () {
      return this.gameState === GAME_STATE.playing;
    },
    isCountdown: function () {
      return this.gameState === GAME_STATE.countdown;
    },
    isIdle: function () {
      return this.gameState === GAME_STATE.idle;
    }
  },
  components: {SpinnerOverlay, Sidebar},
  setup() {
    const collapsed = ref(false);
    const toggleSidebar = () => (collapsed.value = !collapsed.value);
    const SIDEBAR_WIDTH = 250;
    const SIDEBAR_WIDTH_COLLAPSED = 0;
    const sidebarWidth = computed(
      () => `${collapsed.value ? SIDEBAR_WIDTH_COLLAPSED : SIDEBAR_WIDTH}px`
    )
    return {collapsed, toggleSidebar, sidebarWidth}
  },
  props: {
    gameMode: String
  }
};
</script>

<style scoped>

.main {
  display: flex;
  height: 100%;
}

.menu-visible {
  opacity: 0;
  transition: 0.3s all ease;
}

.main .menu .title {
  margin-top: 30px;
}

.main .menu .songName {
  font-size: 20px;
  color: #ff6b3a;
  margin-top: -10px;
  margin-bottom: 10px;
  font-style: italic;
  height: 30px;
}

.main .menu .file {
  display: block;
  margin-top: 50px;
}

.main .menu .buttons {
  display: inline-block;
  margin-top: 30px;
}

.main .content .notesColumns .dropArea {
  position: absolute;
  bottom: 0;
  width: 38px;
  height: 38px;
  background: rgb(165, 180, 252);

}

.main .content .notesColumns .notesColumn {
  position: relative;
  width: 38px;
  height: 100%;
  border-right: 1px solid white;
}

.main .content .notesColumns .notesColumn .note {
  position: absolute;
  height: 38px;
  width: 38px;
  z-index: 2;
}

.main .content .notesColumns .narrowNotesColumn {
  position: relative;
  width: 22px;
  height: 100%;
}

.main .content .notesColumns .narrowNotesColumn .note {
  position: absolute;
  height: 38px;
  width: 22px;
  z-index: 3;
  background: rgb(30,64,175);
}

.main .content .keyboard {
  user-select: none;
}

.main .content .keyboard .whiteKey {
  width: 38px;
  height: 180px;
  border: 1px solid grey;
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;
  background: white;
  cursor: pointer;
  box-shadow: 0px 5px 0 0 rgba(0, 0, 0, 0.2);
  transition: height 30ms linear, box-shadow 30ms linear;
  z-index: 2;
}

.main .content .keyboard .whiteKey.pressed {
  transition: background-color, transform 0.1s ease-out;
  transform: rotateX(-10deg) translateY(-2px);
  background-color: rgba(199, 210, 254);
}

.main .content .keyboard .whiteKey.pressed .keySign {
  bottom: 20px;
  transition: bottom 30ms linear;
}

.main .content .keyboard .whiteKey .keySign {
  position: relative;
  top: 140px;
  color: rgb(31, 41, 55);
  width: 38px;
}

.main .content .keyboard .blackKey {
  width: 22px;
  height: 100px;
  background: rgb(31, 41, 55);
  border: 1px solid transparent;
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;
  box-shadow: 0px 4px 0 0 rgba(0, 0, 0, 0.2);
  cursor: pointer;
  z-index: 3;
  transition: height 30ms linear, box-shadow 30ms linear;
}

.main .content .keyboard .blackKey.pressed {
  transition: background-color, transform 0.1s ease-out;
  transform: rotateX(-10deg);
  background-color: rgba(55, 48, 163);
}

.main .content .keyboard .blackKey.pressed .keySign {
  bottom: 95px;
  transition: bottom 30ms linear;
}

.main .content .keyboard .blackKey .keySign {
  position: relative;
  top: 60px;
  color: white;
  width: 22px;
}

.sidebar {
  transition: 0.3s ease;
  z-index: 2;
}

.collapse-icon {
  transform: translateX(100%);
  transition: 0.3s ease;
  z-index: 1;
}

.arrow-icon {
  transform: translate(-40%) rotate(90deg);
  height: 2em;
  width: 2em;
  display: block;
  position: relative;
  cursor: pointer;
  border-radius: 4px;
}

.arrow-container {
  display: block;
  width: 50px;
  height: 50px;
  transform: translate(-10%, 0%) rotateZ(-90deg);
  transition: all 0.3s ease;
}

.arrow-container.open {
  transform: translate(10%, 0%) rotateZ(90deg);
  transition: all 0.3s ease;
}

.arrow-container:hover {
  cursor: pointer;
}

.arrow-container:hover .arrow {
  top: 50%;
}

.arrow-container:hover .arrow:before {
  transform: translate(-50%, -50%) rotateZ(-30deg);
}

.arrow-container:hover .arrow:after {
  transform: translate(-50%, -50%) rotateZ(30deg);
}

.arrow {
  position: absolute;
  left: 50%;
  transition: all 0.4s ease;
}

.arrow:before, .arrow:after {
  transition: all 0.4s ease;
  content: '';
  display: block;
  position: absolute;
  transform-origin: bottom right;
  background: #fff;
  width: 4px;
  height: 15px;
  border-radius: 10px;
  transform: translate(-50%, -50%) rotateZ(-45deg);
}

.arrow:after {
  transform-origin: bottom left;
  transform: translate(-50%, -50%) rotateZ(45deg);
}

.arrow:nth-child(1) {
  opacity: 0.3;
  top: 35%;
}

.arrow:nth-child(2) {
  opacity: 0.6;
  top: 55%;
}

.arrow:nth-child(3) {
  opacity: 0.9;
  top: 75%;
}

.song-slider {
  transition: width 0.5s ease-in-out;
}

.song-control-btn {
  transition: all 0.2s ease;
}

</style>
