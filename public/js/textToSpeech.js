let speech = new SpeechSynthesisUtterance();

// Set Speech Language
speech.lang = "en";

let voices = [];

window.speechSynthesis.onvoiceschanged = () => {
    voices = window.speechSynthesis.getVoices();

    speech.voice = voices[2];

    let voiceSelect = document.querySelector("#voices");
    voiceSelect.options[0] = new Option(voices[2].name, 2)
    voiceSelect.options[1] = new Option(voices[3].name, 3)

};

document.querySelector("#rate").addEventListener("input", () => {
    const rate = document.querySelector("#rate").value;

    speech.rate = rate;

    document.querySelector("#rate-label").innerHTML = rate;
});

document.querySelector("#volume").addEventListener("input", () => {
    const volume = document.querySelector("#volume").value;

    speech.volume = volume;

    document.querySelector("#volume-label").innerHTML = volume;
});

document.querySelector("#voices").addEventListener("change", () => {
    speech.voice = voices[document.querySelector("#voices").value];
});

function speak(id){
    speech.text = document.querySelector(id).textContent;

    window.speechSynthesis.speak(speech);
}
    
