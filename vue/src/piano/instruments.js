const LIST = [
  "accordion",
  "acoustic_bass",
  "acoustic_grand_piano",
  "acoustic_guitar_nylon",
  "alto_sax",
  "banjo",
  "bird_tweet",
  "brass_section",
  "bright_acoustic_piano",
  "cello",
  "church_organ",
  "clarinet",
  "contrabass",
  "electric_bass_finger",
  "electric_guitar_jazz",
  "electric_piano_1",
  "flute",
  "harmonica",
  "kalimba",
  "koto",
  "music_box",
  "trombone",
  "trumpet",
  "tuba",
  "violin",
  "whistle",
  "xylophone",
];

const NAMES = [
  "Аккордеон",
  "Акустический бас",
  "Фортепиано",
  "Акустическая гитара",
  "Саксофон",
  "Банжо",
  "Пение птиц",
  "Брасс",
  "Фортепиано 2",
  "Виолончель",
  "Орган",
  "Кларнет",
  "Контрабас",
  "Электро-бас",
  "Электро-гитара",
  "Электро-пианино",
  "Флейта",
  "Гармоника",
  "Калимба",
  "Кото",
  "Музыкальная шкатулка",
  "Тромбон",
  "Труба",
  "Туба",
  "Скрипка",
  "Свист",
  "Ксилофон",
];

const INSTRUMENTS = [];
for (let i = 0; i < LIST.length; i++) {
  INSTRUMENTS.push({
    name: LIST[i],
    nameRus: NAMES[i]
  })
}

export default INSTRUMENTS;
