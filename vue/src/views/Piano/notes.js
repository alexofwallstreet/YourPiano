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

export default KEYBOARD_NOTES;
