<template>
  <div class="flex min-h-screen">

    <!-- Sidebar Start -->
    <div
      class="sidebar flex flex-col relative bg-indigo-600 text-white "
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
        <div class="max-w-sm rounded-xl overflow-hidden shadow-lg w-full h-52">
          <img class="w-full h-full object-cover" src="/images/banner.jpg" alt="Sunset in the mountains">
        </div>
        <div class="pt-4">
          <div class="font-bold text-sm text-blue-200 whitespace-nowrap">Неизвестный</div>
          <div class="font-bold text-xl mb-2 whitespace-nowrap">Без названия</div>
        </div>
        <div class="pb-2 flex justify-start">
          <svg v-on:click.prevent="playSong" xmlns="http://www.w3.org/2000/svg"
               class="h-10 w-10 cursor-pointer relative" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                  clip-rule="evenodd"/>
          </svg>
          <svg v-on:click.prevent="pauseSong" xmlns="http://www.w3.org/2000/svg"
               class="h-10 w-10 cursor-pointer relative" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"/>
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 cursor-pointer relative" viewBox="0 0 20 20"
               fill="currentColor">
            <path fill-rule="evenodd"
                  d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                  clip-rule="evenodd"/>
          </svg>
        </div>

        <!-- MIDI Instrument select -->
        <div class="col-span-6 sm:col-span-3 mt-2">
          <label for="instrument" class="block text-sm font-medium text-white whitespace-nowrap">Инструмент</label>
          <select id="instrument" name="country" autocomplete="country-name" v-model="selectedMidiInstrument"
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


        <!--      <b-field-->
        <!--        label="Speed"-->
        <!--        v-bind:horizontal="true"-->
        <!--        v-bind:style="{ 'padding-left': '20px', 'padding-right': '20px' }"-->
        <!--      >-->
        <!--        <b-slider-->
        <!--          type="is-primary"-->
        <!--          size="is-large"-->
        <!--          v-model="songSpeed"-->
        <!--          v-bind:min="0.25"-->
        <!--          v-bind:max="2"-->
        <!--          v-bind:value="1"-->
        <!--          v-bind:step="0.25"-->
        <!--          ticks-->
        <!--        />-->
        <!--      </b-field>-->

        <!--      <b-field-->
        <!--        label="Pianola"-->
        <!--        v-bind:horizontal="true"-->
        <!--        v-bind:style="{ 'padding-left': '20px', 'padding-right': '20px' }"-->
        <!--      >-->
        <!--        <b-switch-->
        <!--          v-bind:rounded="false"-->
        <!--          type="is-primary"-->
        <!--          v-model="inPianolaMode"-->
        <!--        />-->
        <!--      </b-field>-->

        <!--      <b-field-->
        <!--        label="MIDI Device"-->
        <!--        v-bind:horizontal="true"-->
        <!--        v-bind:style="{ 'padding-left': '20px', 'padding-right': '20px' }"-->
        <!--      >-->
        <!--        <b-dropdown-->
        <!--          v-bind:disabled="midiDevices.devices.length === 0"-->
        <!--          v-model="midiDeviceSelected"-->
        <!--          aria-role="list"-->
        <!--        >-->
        <!--          <button-->
        <!--            class="button is-primary"-->
        <!--            slot="trigger"-->
        <!--            slot-scope="{ active }"-->
        <!--          >-->
        <!--            <span>{{-->
        <!--              midiDeviceSelected !== null-->
        <!--                ? midiDeviceSelected-->
        <!--                : "Select a device"-->
        <!--            }}</span>-->
        <!--            <b-icon :icon="active ? 'menu-up' : 'menu-down'"></b-icon>-->
        <!--          </button>-->

        <!--          <b-dropdown-item-->
        <!--            v-for="device in midiDevices.devices"-->
        <!--            v-bind:value="device.name"-->
        <!--            v-bind:key="device.id"-->
        <!--            aria-role="listitem"-->
        <!--          >-->
        <!--            {{ device.name }}-->
        <!--          </b-dropdown-item>-->
        <!--        </b-dropdown>-->
        <!--      </b-field>-->

        <!--      <b-field-->
        <!--        label="Instrument"-->
        <!--        v-bind:horizontal="true"-->
        <!--        v-bind:style="{ 'padding-left': '20px', 'padding-right': '20px' }"-->
        <!--      >-->
        <!--        <b-select-->
        <!--          placeholder="Select an instrument"-->
        <!--          v-bind:disabled="midiInstruments.length === 0"-->
        <!--          v-model="selectedMidiInstrument"-->
        <!--          @input="onInstrumentChange"-->
        <!--        >-->
        <!--          <option-->
        <!--            v-for="instrument in midiInstruments"-->
        <!--            :value="instrument"-->
        <!--            :key="instrument"-->
        <!--          >-->
        <!--            {{ instrument }}-->
        <!--          </option>-->
        <!--        </b-select>-->
        <!--      </b-field>-->

        <!--      <b-field class="file">-->
        <!--        <b-upload v-on:input="loadMidiFile">-->
        <!--          <a class="button is-primary">-->
        <!--            <span>Load Song</span>-->
        <!--          </a>-->
        <!--        </b-upload>-->
        <!--      </b-field>-->

        <!--      <button class="button is-primary" v-on:click="loadFurElise">-->
        <!--        <span>Load Fur Elise</span>-->
        <!--      </button>-->
        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded"
                v-on:click="loadFurElise">Load
        </button>

        <div>Perfect: {{stats.perfect}}</div>
        <div>Good: {{stats.good}}</div>
        <div>Bad: {{stats.bad}}</div>

        <!--      <div class="buttons">-->
        <!--        <b-button-->
        <!--          type="is-primary"-->
        <!--          size="is-large"-->
        <!--          v-bind:disabled="!midiFile || gameState === 2 || gameState === 3"-->
        <!--          v-on:click="playSong"-->
        <!--        >-->
        <!--          &#9654;-->
        <!--        </b-button>-->
        <!--        <b-button-->
        <!--          type="is-primary"-->
        <!--          size="is-large"-->
        <!--          v-bind:disabled="!midiFile || gameState === 1 || gameState === 4"-->
        <!--          v-on:click="pauseSong"-->
        <!--        >-->
        <!--          &#10074;&#10074;-->
        <!--        </b-button>-->

        <!--        <b-button-->
        <!--          type="is-primary"-->
        <!--          size="is-large"-->
        <!--          v-bind:disabled="!midiFile || gameState === 1 || gameState === 4"-->
        <!--          v-on:click="stopSong"-->
        <!--        >-->
        <!--          &#9724;-->
        <!--        </b-button>-->
        <!--      </div>-->
      </div>

    </div>
    <!-- Sidebar End -->

    <div class="flex-1 overflow-auto">
      <div className="main flex lg:justify-center md:justify-start w-full bg-indigo-100">
        <!-- Piano Keyboard + Falling Notes -->
        <div className="content flex flex-col justify-start h-full">
          <!-- Slider -->
          <div v-if="totalSongNotes" class="w-full h-4 bg-gray-300 dark:bg-gray-700 relative z-10">
            <div class="h-4 bg-indigo-500 dark:bg-gray-300 song-slider"  :style="{ width: currentSongNote / totalSongNotes * 100 + '%' }"></div>
          </div>
          <div className="flex h-full">
            <div className="notesColumns" ref="notesColumns">
              <div className="flex h-full">
                <div
                  v-for="(column, cindex) in notesColumns"
                  v-bind:key="`notesColumn_${cindex}`"
                  v-bind:class="{
                notesColumn: !column.isNarrow,
                narrowNotesColumn: column.isNarrow,
              }"
                  v-bind:style="{ 'margin-left': getMarginLeftNotesColumn(cindex) }"
                >
                  <div
                    className="note"
                    v-for="(time, nindex) in column.visibleNotes"
                    v-bind:key="`note_${cindex}_${nindex}`"
                    v-bind:style="{ top: getScreenYPosByTime(time) }"
                  />
                  <div className="dropArea"/>
                </div>
              </div>
            </div>
          </div>
          <div className="keyboard flex z-0">
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
import MidiDevices from "./midi_devices";
import MidiFile from "./midi_file";
import {ref, computed} from 'vue'
import Soundfont from "soundfont-player";
import Sidebar from "../ui/Sidebar.vue";
import KEYBOARD_NOTES from './notes';
import INSTRUMENTS from './instruments';

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

    for (let k of keys) {
      notesColumns.push({
        isNarrow: !this.isWhiteKey(k[0]),
        notes: [],
        visibleNotes: [],
        startNotesIdx: 0,
      });
    }

    return {
      keys: keys,
      keysPressed: {},
      notesColumns: notesColumns,
      prevGameState: null,
      gameState: GAME_STATE.idle,
      midiFile: null,
      midiDevices: new MidiDevices(this.onDeviceKeyDown, this.onDeviceKeyUp),
      midiDeviceSelected: "Выберите устройство",
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
    };
  },
  mounted: function () {
    window.addEventListener("keydown", this.onKeyDown);
    window.addEventListener("keyup", this.onKeyUp);

    this.start = Date.now();
    this.playTime = 0;
    this.prevPlayTime = 0;
    this.animFrameId = window.requestAnimationFrame(this.tick);
    this.initAudio();
    this.setGameState(GAME_STATE.countdown)
    // this.$buefy.dialog.alert({
    //   title: "Welcome!",
    //   message:
    //     "OK" +
    //     "Piano Hero enables you to play the piano freely or following a pattern. It´s just an experiment, so probably it contains some bugs.",
    //   onConfirm: this.onWelcomeDialogClosed,
    // });
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

          if (this.timer <= 0) {
            this.setGameState(GAME_STATE.playing);
          }
          break;

        case GAME_STATE.playing:
          this.computeNotesState();
          this.computeMissingNotes();

          if (this.inPianolaMode) {
            const self = this;
            for (const column of this.notesColumns) {
              for (const note of column.notes) {
                if (
                  this.playTime >= note.time &&
                  note.time > this.prevPlayTime
                ) {
                  this.onNoteOn(note.note, note.octave);
                  this.currentSongNote++;
                  setTimeout(() => self.onNoteOff(note.note, note.octave), 200);
                }
              }
            }
          }

          this.prevPlayTime = this.playTime;
          this.playTime += delta;

          if (this.playTime > this.lastNoteTime + NOTE_EXTRA_TIME) {
            this.stopSong();

            // if (!this.inPianolaMode) {
            //   this.$buefy.dialog.alert({
            //     title: "Game Over",
            //     message: `Notes - Perfect: ${this.stats.perfect} | Good: ${this.stats.good} | Bad: ${this.stats.bad}`,
            //   });
            // }
          }
          break;
      }

      this.animFrameId = window.requestAnimationFrame(this.tick);
    },
    initAudio: function () {
      console.log("Start init");
      this.audioContext = new window.AudioContext();
      this.soundfont = Soundfont.instrument(
        this.audioContext, this.selectedMidiInstrument
      ).then(function (instrument) {
        console.log("Init complete");
        return instrument;
      });
    },
    unsetAudio: function () {
      this.audioContext.close();
    },
    onInstrumentChange: function (newInstrument) {
      this.selectedMidiInstrument = newInstrument.target.value;
      this.initAudio();
    },
    isWhiteKey: function (note) {
      return note.length === 1;
    },
    isKeyPressed: function (note, octave) {
      return this.keysPressed[this.getNoteId(note, octave)];
    },
    playNote: function (note, octave) {
      this.soundfont.then(function (instrument) {
        instrument.play(`${note}${octave}`, null, {
          duration: 1,
          gain: 2, //TODO: Implemets volume changing
        });
      });
    },
    onKeyDown: function (event) {
      event.preventDefault();
      const key = event.keyCode;
      if (key in KEYBOARD_NOTES) {
        const noteInfo = KEYBOARD_NOTES[key];
        this.onNoteOn(noteInfo.note, noteInfo.octave);
      }
    },
    onKeyUp: function (event) {
      event.preventDefault();
      const key = event.keyCode;
      if (key in KEYBOARD_NOTES) {
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

      //PIANOLA = TUTORIAL MODE
      if (this.gameState === GAME_STATE.playing && !this.inPianolaMode) {
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
      console.log(this.lastNoteTime);
      console.log(this.playTime);
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

      const filePath = "/static/midi_example.mid";

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
      this.setGameState(GAME_STATE.paused);
    },
    stopSong: function () {
      this.currentSongNote = 0;
      this.setGameState(GAME_STATE.idle);
      this.prevGameState = GAME_STATE.idle;
    },
  },
  components: {Sidebar},
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
  background: rgb(31, 41, 55);
  border-right: 1px solid white;
}

.main .content .notesColumns .notesColumn .note {
  position: absolute;
  height: 38px;
  width: 38px;
  border: 2px solid #ebdec4;
  border-radius: 8px;
  background: #f05e3b;
  z-index: 2;
}

.main .content .notesColumns .narrowNotesColumn {
  position: relative;
  width: 22px;
  height: 100%;
  z-index: 1;
  background: rgb(31, 41, 55);
}

.main .content .notesColumns .narrowNotesColumn .note {
  position: absolute;
  height: 38px;
  width: 22px;
  border: 2px solid #ebdec4;
  border-radius: 6px;
  background: #4bae8c;
  z-index: 2;
}

.main .content .keyboard {
  user-select: none;
  height: 185px;
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
  transition: width 1s ease-in-out;
}

</style>
