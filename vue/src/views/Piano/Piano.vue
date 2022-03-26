<template>
  <div class="flex">
    <aside class="w-64" aria-label="Sidebar">
      <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800 h-full">
        <ul class="space-y-2">
          <li>
            <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
              <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
              <span class="ml-3">Dashboard</span>
            </a>
          </li>
          <div className="title is-2">YourPiano</div>

          <div className="songName">{{ midiFile ? midiFile.songName : "" }}</div>

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
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" v-on:click="loadFurElise">Load</button>

          <!--      <div class="buttons">-->
          <!--        <b-button-->
          <!--          type="is-primary"-->
          <!--          size="is-large"-->
          <!--          v-bind:disabled="!midiFile || gameState === 2 || gameState === 3"-->
          <!--          v-on:click="playSong"-->
          <!--        >-->
          <!--          &#9654;-->
          <!--        </b-button>-->
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" v-on:click.prevent="playSong">Play</button>
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
        </ul>
      </div>
    </aside>
    <div className="main flex">
      <!-- Piano Keyboard + Falling Notes -->
      <div className="content h-screen">
        <div className="flex" v-bind:style="{ height: 'calc(100% - 200px)' }">
          <div className="notesColumns column" ref="notesColumns">
            <div className="flex">
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
        <div className="keyboard flex">
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
</template>

<script>
import MidiDevices from "./midi_devices";
import MidiFile from "./midi_file";
import Soundfont from "soundfont-player";

const BLACK_KEY_WIDTH = 22;
const NOTE_HEIGHT = 38;
const VISIBILITY_RANGE = 5; // seconds
const OCTAVE_BASE = 3;
//const OCTAVE_MAX = 5;
const NOTE_EXTRA_TIME = 0.3; // seconds = extra time before note is computed as missing
const MIDI_VALUE_C2 = 36;
const NOTES = ["C", "C#", "D", "D#", "E", "F", "F#", "G", "G#", "A", "A#", "B"];

let idIncrement = 0;

const KEYBOARD_NOTES = {
  /*
   ** 1 OCTAVE
   */
  81: {
    keyCode: "Q",
    note: "C",
    octave: 3,
    id: idIncrement++,
  },
  50: {
    keyCode: "2",
    note: "C#",
    octave: 3,
    id: idIncrement++,
  },
  87: {
    keyCode: "W",
    note: "D",
    octave: 3,
    id: idIncrement++,
  },
  51: {
    keyCode: "3",
    note: "D#",
    octave: 3,
    id: idIncrement++,
  },
  69: {
    keyCode: "E",
    note: "E",
    octave: 3,
    id: idIncrement++,
  },
  82: {
    keyCode: "R",
    note: "F",
    octave: 3,
    id: idIncrement++,
  },
  53: {
    keyCode: "5",
    note: "F#",
    octave: 3,
    id: idIncrement++,
  },
  84: {
    keyCode: "T",
    note: "G",
    octave: 3,
    id: idIncrement++,
  },
  54: {
    keyCode: "6",
    note: "G#",
    octave: 3,
    id: idIncrement++,
  },
  89: {
    keyCode: "Y",
    note: "A",
    octave: 3,
    id: idIncrement++,
  },
  55: {
    keyCode: "7",
    note: "A#",
    octave: 3,
    id: idIncrement++,
  },
  85: {
    keyCode: "U",
    note: "B",
    octave: 3,
    id: idIncrement++,
  },

  /*
   ** 2 OCTAVE
   */

  73: {
    keyCode: "I",
    note: "C",
    octave: 4,
    id: idIncrement++,
  },
  57: {
    keyCode: "9",
    note: "C#",
    octave: 4,
    id: idIncrement++,
  },
  79: {
    keyCode: "O",
    note: "D",
    octave: 4,
    id: idIncrement++,
  },
  48: {
    keyCode: "0",
    note: "D#",
    octave: 4,
    id: idIncrement++,
  },
  80: {
    keyCode: "P",
    note: "E",
    octave: 4,
    id: idIncrement++,
  },
  219: {
    keyCode: "[",
    note: "F",
    octave: 4,
    id: idIncrement++,
  },
  [navigator.userAgent.toLowerCase().indexOf("firefox") > -1 ? 61 : 187]: {
    keyCode: "+",
    note: "F#",
    octave: 4,
    id: idIncrement++,
  },
  221: {
    keyCode: "]",
    note: "G",
    octave: 4,
    id: idIncrement++,
  },
  65: {
    keyCode: "A",
    note: "G#",
    octave: 4,
    id: idIncrement++,
  },
  90: {
    keyCode: "Z",
    note: "A",
    octave: 4,
    id: idIncrement++,
  },
  83: {
    keyCode: "S",
    note: "A#",
    octave: 4,
    id: idIncrement++,
  },
  88: {
    keyCode: "X",
    note: "B",
    octave: 4,
    id: idIncrement++,
  },

  /*
   ** 3 OCTAVE
   */

  67: {
    keyCode: "C",
    note: "C",
    octave: 5,
    id: idIncrement++,
  },
  70: {
    keyCode: "F",
    note: "C#",
    octave: 5,
    id: idIncrement++,
  },
  86: {
    keyCode: "V",
    note: "D",
    octave: 5,
    id: idIncrement++,
  },
  71: {
    keyCode: "G",
    note: "D#",
    octave: 5,
    id: idIncrement++,
  },
  66: {
    keyCode: "B",
    note: "E",
    octave: 5,
    id: idIncrement++,
  },
  78: {
    keyCode: "N",
    note: "F",
    octave: 5,
    id: idIncrement++,
  },
  74: {
    keyCode: "J",
    note: "F#",
    octave: 5,
    id: idIncrement++,
  },
  77: {
    keyCode: "M",
    note: "G",
    octave: 5,
    id: idIncrement++,
  },
  75: {
    keyCode: "K",
    note: "G#",
    octave: 5,
    id: idIncrement++,
  },
  188: {
    keyCode: ",",
    note: "A",
    octave: 5,
    id: idIncrement++,
  },
  76: {
    keyCode: "L",
    note: "A#",
    octave: 5,
    id: idIncrement++,
  },
  190: {
    keyCode: ".",
    note: "B",
    octave: 5,
    id: idIncrement++,
  },
  /*
   ** OCTAVE 6
   */
  191: {
    keyCode: "/",
    note: "C",
    octave: 6,
    id: idIncrement++,
  },
};

const INSTRUMENTS = [
  "accordion",
  "acoustic_bass",
  "acoustic_grand_piano",
  "acoustic_guitar_nylon",
  "acoustic_guitar_steel",
  "agogo",
  "alto_sax",
  "applause",
  "bagpipe",
  "banjo",
  "baritone_sax",
  "bassoon",
  "bird_tweet",
  "blown_bottle",
  "brass_section",
  "breath_noise",
  "bright_acoustic_piano",
  "celesta",
  "cello",
  "choir_aahs",
  "church_organ",
  "clarinet",
  "clavinet",
  "contrabass",
  "distortion_guitar",
  "drawbar_organ",
  "dulcimer",
  "electric_bass_finger",
  "electric_bass_pick",
  "electric_grand_piano",
  "electric_guitar_clean",
  "electric_guitar_jazz",
  "electric_guitar_muted",
  "electric_piano_1",
  "electric_piano_2",
  "english_horn",
  "fiddle",
  "flute",
  "french_horn",
  "fretless_bass",
  "fx_1_rain",
  "fx_2_soundtrack",
  "fx_3_crystal",
  "fx_4_atmosphere",
  "fx_5_brightness",
  "fx_6_goblins",
  "fx_7_echoes",
  "fx_8_scifi",
  "glockenspiel",
  "guitar_fret_noise",
  "guitar_harmonics",
  "gunshot",
  "harmonica",
  "harpsichord",
  "helicopter",
  "honkytonk_piano",
  "kalimba",
  "koto",
  "lead_1_square",
  "lead_2_sawtooth",
  "lead_3_calliope",
  "lead_4_chiff",
  "lead_5_charang",
  "lead_6_voice",
  "lead_7_fifths",
  "lead_8_bass__lead",
  "marimba",
  "melodic_tom",
  "music_box",
  "muted_trumpet",
  "oboe",
  "ocarina",
  "orchestra_hit",
  "orchestral_harp",
  "overdriven_guitar",
  "pad_1_new_age",
  "pad_2_warm",
  "pad_3_polysynth",
  "pad_4_choir",
  "pad_5_bowed",
  "pad_6_metallic",
  "pad_7_halo",
  "pad_8_sweep",
  "pan_flute",
  "percussive_organ",
  "piccolo",
  "pizzicato_strings",
  "recorder",
  "reed_organ",
  "reverse_cymbal",
  "rock_organ",
  "seashore",
  "shakuhachi",
  "shamisen",
  "shanai",
  "sitar",
  "slap_bass_1",
  "slap_bass_2",
  "soprano_sax",
  "steel_drums",
  "string_ensemble_1",
  "string_ensemble_2",
  "synth_bass_1",
  "synth_bass_2",
  "synth_brass_1",
  "synth_brass_2",
  "synth_choir",
  "synth_drum",
  "synth_strings_1",
  "synth_strings_2",
  "taiko_drum",
  "tango_accordion",
  "telephone_ring",
  "tenor_sax",
  "timpani",
  "tinkle_bell",
  "tremolo_strings",
  "trombone",
  "trumpet",
  "tuba",
  "tubular_bells",
  "vibraphone",
  "viola",
  "violin",
  "voice_oohs",
  "whistle",
  "woodblock",
  "xylophone",
];

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

    // let octave = OCTAVE_BASE;
    // let keys = [];
    // for (let o = 0; o < 3; ++o) {
    //   for (const n of NOTES) {
    //     keys.push([n, octave]);
    //   }
    //   ++octave;
    // }
    // keys.push(["C", 6]);

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
      midiDeviceSelected: null,
      songSpeed: 1,
      inPianolaMode: true,
      stats: {
        perfect: 0,
        good: 0,
        bad: 0,
      },
      midiInstruments: INSTRUMENTS,
      selectedMidiInstrument: INSTRUMENTS[2],
    };
  },
  created: function () {
    window.addEventListener("keydown", this.onKeyDown);
    window.addEventListener("keyup", this.onKeyUp);

    this.start = Date.now();
    this.playTime = 0;
    this.prevPlayTime = 0;
    this.animFrameId = window.requestAnimationFrame(this.tick);
    this.initAudio();
    this.loadFurElise();
    // this.$buefy.dialog.alert({
    //   title: "Welcome!",
    //   message:
    //     "OK" +
    //     "Piano Hero enables you to play the piano freely or following a pattern. It´s just an experiment, so probably it contains some bugs.",
    //   onConfirm: this.onWelcomeDialogClosed,
    // });
  },
  destroyed: function () {
    if (this.animFrameId) {
      window.cancelAnimationFrame(this.animFrameId);
    }

    window.removeEventListener("keyup", this.onKeyUp);
    window.removeEventListener("keydown", this.onKeyDown);
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
          console.log('HERE')
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
        this.audioContext,
        this.selectedMidiInstrument
      ).then(function (instrument) {
        console.log("Init complete");
        return instrument;
      });
    },
    onInstrumentChange: function (newInstrument) {
      this.selectedMidiInstrument = newInstrument;
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
      // Vue.set(this.keysPressed, noteId, true);
      this.keysPressed[noteId] = true;

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

      const filePath = "/static/beethoven_fur_elise.mid";

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
    onWelcomeDialogClosed: function () {
      this.initAudio();
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
        this.$refs.notesColumns.clientHeight -
        NOTE_HEIGHT
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
      this.setGameState(GAME_STATE.idle);
      this.prevGameState = GAME_STATE.idle;
    },
  },
};
</script>

<style scoped>

.main {
  display: flex;
  height: 100%;
  background: white;
}

.main .menu {
  width: 300px;
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

.main .content .columns {
  margin-bottom: 0px;
}

.main .content .notesColumns .columns {
  height: 100%;
}

.main .content .notesColumns .dropArea {
  position: absolute;
  bottom: 200px;
  width: 38px;
  height: 38px;
  background: #efe0bc;
}

.main .content .notesColumns .notesColumn {
  width: 38px;
  height: 100%;
  overflow: hidden;
  background: black;
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
  width: 22px;
  height: 100%;
  z-index: 1;
  background: black;
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
  position: absolute;
  bottom: 0;
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
  height: 185px;
  box-shadow: none;
  transition: height 30ms linear, box-shadow 30ms linear;
  background: yellow;
}

.main .content .keyboard .whiteKey.pressed .keySign {
  bottom: 20px;
  transition: bottom 30ms linear;
}

.main .content .keyboard .whiteKey .keySign {
  position: absolute;
  bottom: 25px;
  color: black;
  width: 38px;
}

.main .content .keyboard .blackKey {
  width: 22px;
  height: 100px;
  background: black;
  border: 1px solid transparent;
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;
  box-shadow: 0px 4px 0 0 rgba(0, 0, 0, 0.2);
  cursor: pointer;
  z-index: 3;
  transition: height 30ms linear, box-shadow 30ms linear;
}

.main .content .keyboard .blackKey.pressed {
  height: 105px;
  box-shadow: none;
  border: 1px solid grey;
  transition: height 30ms linear, box-shadow 30ms linear;
  background: yellow;
}

.main .content .keyboard .blackKey.pressed .keySign {
  color: black;
  bottom: 95px;
  transition: bottom 30ms linear;
}

.main .content .keyboard .blackKey .keySign {
  position: absolute;
  bottom: 100px;
  color: white;
  width: 22px;
}

</style>
