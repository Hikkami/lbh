// Baza podzielona na kategorie + dodane mnemotechniki (ciekawostki) do nauki
const quizData = [
    // KAMPANIA WRZEŚNIOWA
    { cat: "Kampania Wrześniowa (1939)", date: "01.09.1939", event: "Atak III Rzeszy na Polskę (Wieluń i Westerplatte)", hint: "Zanim pancernik Schleswig-Holstein zaatakował Westerplatte o 4:45, bomby spadły na uśpione miasto Wieluń." },
    { cat: "Kampania Wrześniowa (1939)", date: "03.09.1939", event: "Wypowiedzenie wojny Niemcom przez Wielką Brytanię i Francję", hint: "Początek tzw. 'dziwnej wojny'. Zamiast strzelać, sojusznicy zrzucali nad Niemcami ulotki propagandowe." },
    { cat: "Kampania Wrześniowa (1939)", date: "09-22.09.1939", event: "Bitwa nad Bzurą", hint: "Największa bitwa kampanii i jedyny polski zorganizowany kontratak pod dowództwem gen. Tadeusza Kutrzeby." },
    { cat: "Kampania Wrześniowa (1939)", date: "17.09.1939", event: "Atak ZSRR na Polskę", hint: "Cios w plecy ze wschodu. Doprowadził do ewakuacji polskiego rządu do Rumunii, a stamtąd do Francji." },
    { cat: "Kampania Wrześniowa (1939)", date: "28.09.1939", event: "Kapitulacja oblężonej Warszawy", hint: "Stolica broniła się heroicznie (od 8 września), poddając się dopiero pod koniec miesiąca z powodu braku amunicji i żywności." },
    { cat: "Kampania Wrześniowa (1939)", date: "02-05.10.1939", event: "Bitwa pod Kockiem", hint: "Ostatnia bitwa obronna Polaków, stoczona przez Samodzielną Grupę Operacyjną 'Polesie' gen. Kleeberga." },
    
    // EKSPANSJA NIEMIEC I ZSRR
    { cat: "Ekspansja Niemiec i ZSRR (1939-1941)", date: "30.11.1939", event: "Wybuch wojny radziecko-fińskiej (wojna zimowa)", hint: "Mała Finlandia stawiła potężny opór gigantowi, choć ostatecznie straciła 10% terytorium." },
    { cat: "Ekspansja Niemiec i ZSRR (1939-1941)", date: "09.04.1940", event: "Atak Niemiec na Danię i Norwegię", hint: "Wiosenna ofensywa, która zabezpieczyła Niemcom szlaki dostaw kluczowej szwedzkiej rudy żelaza." },
    { cat: "Ekspansja Niemiec i ZSRR (1939-1941)", date: "10.05.1940", event: "Atak Niemiec na Francję i kraje Beneluksu", hint: "Miesiąc po ataku na Skandynawię, Hitler ruszył na zachód omijając słynną Linię Maginota." },
    { cat: "Ekspansja Niemiec i ZSRR (1939-1941)", date: "22.06.1940", event: "Kapitulacja Francji", hint: "Francję podzielono (powstał m.in. kolaboracyjny rząd Vichy). Pamiętaj datę: dokładnie rok później Hitler zaatakuje ZSRR!" },
    { cat: "Ekspansja Niemiec i ZSRR (1939-1941)", date: "10.07 - 31.10.1940", event: "Bitwa o Anglię", hint: "Starcie w powietrzu. Alianci wygrali dzięki systemowi radarów i świetnym pilotom (w tym polskiemu Dywizjonowi 303)." },
    
    // FRONT WSCHODNI
    { cat: "Front Wschodni (Niemcy vs ZSRR)", date: "22.06.1941", event: "Atak Niemiec na ZSRR (Plan Barbarossa)", hint: "Zwróć uwagę na datę: 22 czerwca. Dokładnie w ten sam dzień rok wcześniej kapitulowała Francja! Trzy cele: Leningrad, Moskwa, Kijów." },
    { cat: "Front Wschodni (Niemcy vs ZSRR)", date: "08.1942 - 02.1943", event: "Bitwa pod Stalingradem", hint: "Kocioł stalingradzki. Najkrwawsza bitwa wojny. Zima i radziecki kontratak zniszczyły niemiecką 6. Armię Paulusa." },
    { cat: "Front Wschodni (Niemcy vs ZSRR)", date: "02.02.1943", event: "Kapitulacja Niemców pod Stalingradem", hint: "To wydarzenie uważa się za absolutny przełom i punkt zwrotny II Wojny Światowej na froncie wschodnim." },
    { cat: "Front Wschodni (Niemcy vs ZSRR)", date: "05.07 - 23.08.1943", event: "Bitwa na Łuku Kurskim", hint: "Największa bitwa pancerna (czołgów) w historii. Ostatecznie złamała siły ofensywne Niemiec na wschodzie." },
    
    // FRONT AFRYKAŃSKI I WŁOSKI
    { cat: "Front Afrykański i Włoski", date: "02.1941", event: "Przybycie Afrika Korps do Afryki Północnej", hint: "Korpus gen. Erwina Rommla ('Lisa Pustyni') przybył ratować przegrywających Włochów. Stawką był m.in. Kanał Sueski." },
    { cat: "Front Afrykański i Włoski", date: "23.10 - 04.11.1942", event: "II bitwa pod El Alamejn", hint: "Wielkie zwycięstwo aliantów, które zapoczątkowało wypieranie sił Osi z Afryki Północnej." },
    { cat: "Front Afrykański i Włoski", date: "10.07.1943", event: "Lądowanie aliantów na Sycylii", hint: "Operacja Husky. Wojna znów 'wkroczyła' do Europy. Skutkowała obaleniem Mussoliniego we Włoszech." },
    { cat: "Front Afrykański i Włoski", date: "18.05.1944", event: "Zdobycie klasztoru Monte Cassino", hint: "Czerwone maki na Monte Cassino! Drogę do Rzymu otworzył 2. Korpus Polski dowodzony przez gen. Andersa." },
    { cat: "Front Afrykański i Włoski", date: "04.06.1944", event: "Wyzwolenie Rzymu przez aliantów", hint: "Miało to miejsce na zaledwie dwa dni przed lądowaniem w Normandii!" },
    
    // FRONT ZACHODNI I KONIEC
    { cat: "Front Zachodni i Koniec Wojny", date: "06.06.1944", event: "Lądowanie aliantów w Normandii (D-Day)", hint: "6 czerwca o 6 rano. Magiczna 'szóstka'. Operacja Overlord otworzyła drugi front w Europie." },
    { cat: "Front Zachodni i Koniec Wojny", date: "20.07.1944", event: "Zamach na Hitlera w Wilczym Szańcu (Gierłoż)", hint: "Zamach płk. Stauffenberga miał miejsce latem, na zaledwie kilkanaście dni przed wybuchem Powstania Warszawskiego." },
    { cat: "Front Zachodni i Koniec Wojny", date: "25.08.1944", event: "Wyzwolenie Paryża", hint: "Krótko po rozpoczęciu Powstania Warszawskiego, zachodni alianci radośnie wyzwolili stolicę Francji." },
    { cat: "Front Zachodni i Koniec Wojny", date: "17-25.09.1944", event: "Operacja Market Garden (Arnhem)", hint: "Wielka i tragiczna w skutkach klęska powietrznodesantowa aliantów w Holandii." },
    { cat: "Front Zachodni i Koniec Wojny", date: "18.03.1945", event: "Zaślubiny Polski z morzem w Kołobrzegu", hint: "Symboliczny akt potwierdzający dotarcie odrodzonego Wojska Polskiego do wybrzeży Bałtyku." },
    { cat: "Front Zachodni i Koniec Wojny", date: "30.04.1945", event: "Samobójstwo Adolfa Hitlera", hint: "Wódz III Rzeszy nie doczekał maja. Zginął w przedostatni dzień kwietnia w bunkrze w oblężonym Berlinie." },
    { cat: "Front Zachodni i Koniec Wojny", date: "08.05.1945", event: "Bezwarunkowa kapitulacja III Rzeszy", hint: "Dzień Zwycięstwa. Maj 1945 r. - oficjalny koniec koszmaru II Wojny Światowej w Europie." },
    
    // KATYŃ I POWSTANIE
    { cat: "Zbrodnia Katyńska i Powstanie Warszawskie", date: "05.03.1940", event: "Podpisanie decyzji o zbrodni katyńskiej", hint: "Stalin wydał rozkaz rozstrzelania ok. 22 tys. polskich oficerów na długo przed atakiem Niemiec na ZSRR." },
    { cat: "Zbrodnia Katyńska i Powstanie Warszawskie", date: "13.04.1943", event: "Odkrycie masowych grobów w Katyniu przez Niemców", hint: "Informacja o masowych grobach wyszła na jaw 3 lata po samej zbrodni." },
    { cat: "Zbrodnia Katyńska i Powstanie Warszawskie", date: "25.04.1943", event: "Zerwanie stosunków ZSRR z rządem RP w Londynie", hint: "Krótko po odkryciu grobów, Stalin oskarżył Polaków o kolaborację z Niemcami i zerwał stosunki dyplomatyczne." },
    { cat: "Zbrodnia Katyńska i Powstanie Warszawskie", date: "04.07.1943", event: "Katastrofa gibraltarska", hint: "Zginął w niej gen. Władysław Sikorski – najważniejszy polski polityk i wódz naczelny na emigracji." },
    { cat: "Zbrodnia Katyńska i Powstanie Warszawskie", date: "01.08.1944", event: "Wybuch Powstania Warszawskiego", hint: "Godzina 'W' - 1 sierpnia o godzinie 17:00. Powstanie trwało równe 63 dni." },
    
    // HOLOKAUST I PACYFIK
    { cat: "Holokaust i Wojna na Pacyfiku", date: "07.12.1941", event: "Atak Japonii na Pearl Harbor", hint: "Wydarzenie to sprawiło, że USA dołączyło do konfliktu, co uczyniło wojnę prawdziwie globalną." },
    { cat: "Holokaust i Wojna na Pacyfiku", date: "20.01.1942", event: "Konferencja w Wannsee", hint: "Urzędnicza konferencja, na której zapadła decyzja o Ostatecznym Rozwiązaniu (przemysłowym wymordowaniu Żydów)." },
    { cat: "Holokaust i Wojna na Pacyfiku", date: "04-07.06.1942", event: "Bitwa o Midway", hint: "Sześć miesięcy po Pearl Harbor, Amerykanie zatopili 4 japońskie lotniskowce. Przełom na Pacyfiku." },
    { cat: "Holokaust i Wojna na Pacyfiku", date: "06 i 09.08.1945", event: "Zrzucenie bomb atomowych na Hiroszimę i Nagasaki", hint: "Użycie absolutnie destrukcyjnej nowej broni, co złamało wolę oporu Cesarstwa Japonii." },
    { cat: "Holokaust i Wojna na Pacyfiku", date: "02.09.1945", event: "Kapitulacja Japonii (Koniec II Wojny Światowej)", hint: "Wojna rozpoczęła się 1 września 1939, a zakończyła 2 września, równiutko 6 lat i 1 dzień później." }
];

const allDates = [...new Set(quizData.map(item => item.date))];
const allEvents = [...new Set(quizData.map(item => item.event))];

let currentQuestions = [];
let currentQuestionIndex = 0;
let score = 0;
let mistakes = 0;
let currentIsReverse = false;

// Pobieranie kategorii do menu
const categories = [...new Set(quizData.map(item => item.cat))];

window.onload = () => {
    const container = document.getElementById('category-container');
    categories.forEach(cat => {
        const btn = document.createElement('button');
        btn.className = 'category-btn';
        btn.innerText = cat;
        btn.onclick = () => startQuiz(cat);
        container.appendChild(btn);
    });

    const allBtn = document.createElement('button');
    allBtn.className = 'category-btn all-btn';
    // Dynamiczna wartość długości tablicy
    allBtn.innerText = `Wielki Test (Wszystkie ${quizData.length} Pytań)`;
    allBtn.onclick = () => startQuiz('all');
    container.appendChild(allBtn);
};

function showStartScreen() {
    document.getElementById('result-screen').style.display = 'none';
    document.getElementById('quiz-screen').style.display = 'none';
    document.getElementById('start-screen').style.display = 'block';
}

function shuffleArray(array) {
    let arr = [...array];
    for (let i = arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
}

function startQuiz(category) {
    score = 0;
    mistakes = 0;
    currentQuestionIndex = 0;
    
    if (category === 'all') {
        currentQuestions = shuffleArray(quizData);
    } else {
        currentQuestions = shuffleArray(quizData.filter(q => q.cat === category));
    }

    document.getElementById('score').innerText = score;
    document.getElementById('start-screen').style.display = 'none';
    document.getElementById('quiz-screen').style.display = 'block';
    
    loadQuestion();
}

function loadQuestion() {
    document.getElementById('next-btn').style.display = 'none';
    document.getElementById('hint-box').style.display = 'none';
    
    document.getElementById('current-q-num').innerText = currentQuestionIndex + 1;
    document.getElementById('total-q-num').innerText = currentQuestions.length;
    
    const currentQ = currentQuestions[currentQuestionIndex];
    
    // Losowanie trybu odwróconego (50% szans)
    currentIsReverse = Math.random() > 0.5;

    let correctText, wrongBank;
    
    if (currentIsReverse) {
        document.getElementById('question-type-label').innerText = "Co się wtedy wydarzyło?";
        document.getElementById('question-text').innerText = currentQ.date;
        correctText = currentQ.event;
        wrongBank = allEvents.filter(e => e !== correctText);
    } else {
        document.getElementById('question-type-label').innerText = "Kiedy to było?";
        document.getElementById('question-text').innerText = currentQ.event;
        correctText = currentQ.date;
        wrongBank = allDates.filter(d => d !== correctText);
    }

    // Losowanie 3 błędnych odpowiedzi
    let wrongOptions = shuffleArray(wrongBank).slice(0, 3);
    
    let options = [{ text: correctText, isCorrect: true }];
    wrongOptions.forEach(w => options.push({ text: w, isCorrect: false }));
    options = shuffleArray(options);

    const optionsContainer = document.getElementById('options-container');
    optionsContainer.innerHTML = '';
    
    const letters = ['A', 'B', 'C', 'D'];

    options.forEach((opt, index) => {
        const btn = document.createElement('button');
        btn.className = 'option-btn';
        btn.innerHTML = `<strong>${letters[index]}.</strong> ${opt.text}`;
        
        // Zapisujemy, czy przycisk ma poprawną odpowiedź, bezpośrednio do właściwości JS
        // Dzięki temu unikamy błędu przy btn.innerHTML.includes(), gdy teksty są podobne.
        btn.isCorrectAnswer = opt.isCorrect;

        btn.onclick = () => selectAnswer(btn, opt.isCorrect, optionsContainer, currentQ.hint);
        optionsContainer.appendChild(btn);
    });
}

function selectAnswer(selectedBtn, isCorrect, container, hintText) {
    const buttons = container.querySelectorAll('.option-btn');
    
    // Zablokuj przyciski i pokaż poprawną odpowiedź (korzystając z właściwości isCorrectAnswer)
    buttons.forEach(btn => {
        btn.disabled = true;
        if (btn.isCorrectAnswer) {
            btn.classList.add('correct');
        }
    });

    if (isCorrect) {
        score++;
        document.getElementById('score').innerText = score;
    } else {
        selectedBtn.classList.add('wrong');
        mistakes++;
        
        // "PIEKŁO BŁĘDÓW" - pytanie wraca na koniec!
        currentQuestions.push(currentQuestions[currentQuestionIndex]);
        document.getElementById('total-q-num').innerText = currentQuestions.length;
    }

    // Pokaż mnemotechnikę (ciekawostkę)
    document.getElementById('hint-text').innerText = hintText;
    document.getElementById('hint-box').style.display = 'block';

    document.getElementById('next-btn').style.display = 'block';
}

function nextQuestion() {
    currentQuestionIndex++;
    if (currentQuestionIndex < currentQuestions.length) {
        loadQuestion();
    } else {
        showResult();
    }
}

function showResult() {
    document.getElementById('quiz-screen').style.display = 'none';
    document.getElementById('result-screen').style.display = 'block';
    document.getElementById('mistakes-count').innerText = mistakes;
}