@extends('user-layouts.master')

<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        transition: opacity 0.3s ease-in-out;
    }

    .modal.show {
        display: flex;
        opacity: 1;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .quiz-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 90%;
        max-width: 500px;
        text-align: left;
        /* Rata kiri untuk konten modal */
    }

    .quiz-container h1 {
        font-size: 24px;
        margin-bottom: 10px;
        text-align: center;
        /* Judul tetap di tengah */
    }

    .quiz-container p {
        font-size: 16px;
        color: #333;
        margin-bottom: 20px;
        text-align: left;
        /* Rata kiri untuk teks */
    }

    .quiz-container .divider {
        width: 60%;
        height: 2px;
        background-color: #d3d3d3;
        margin: 10px auto 20px;
    }

    .quiz-container button {
        padding: 10px 20px;
        background-color: #f1f1de !important;
        border: none;
        border-radius: 5px;
        color: #000 !important;
        font-weight: bold;
        cursor: pointer;
        margin: 5px;
    }

    .quiz-container .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    .question {
        text-align: left;
        /* Rata kiri untuk teks soal */
        margin-bottom: 20px;
    }

    .question p {
        margin-left: 20px;
    }

    .question .option {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .question .option input {
        margin-right: 10px;
        /* Jarak antara radio button dan teks opsi */
        margin-left: 20px
    }

    .question .option label {
        font-size: 16px;
        color: #333;
    }
</style>

@section('content')
    <div class="section started" id="section-started">

        <!-- Background -->
        <div id="started-video-bg" class="video-bg media-bg jarallax-video video-mobile-bg"
            data-jarallax-video="mp4:{{ asset('user-assets/videos/background.mp4') }}">
            <div class="video-bg-mask"></div>
            <div class="video-bg-texture" id="grained_container"></div>
        </div>

        <div class="centrize full-width">
            <div class="vertical-center">
                <div class="started-content">
                    <div class="h-title"></div>
                    <div class="h-subtitle typing-subtitle">
                        <a href="#" id="openModal"
                            style="display: inline-block; padding: 1px 24px; background-color: #f1f1de; color: #000; text-decoration: none; font-size: 16px; border-radius: 5px; font-weight: bold;">
                            Please Fill The Answer For This Quisioner
                        </a>
                    </div>
                    <span class="typed-subtitle"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quiz Modal -->
    <div id="quizModal" class="modal">
        <div class="quiz-container">
            <div class="close-btn">&times;</div>
            <h1>Please fill out the questionnaire!</h1>
            <div class="divider"></div>

            <!-- Form untuk menyimpan jawaban -->
            <form id="survey-form" action="{{ route('survey.submit') }}" method="POST">
                @csrf
                <div id="question-container">
                    <!-- Questions will be injected dynamically -->
                </div>

                <!-- Hidden input untuk menyimpan jawaban -->
                <input type="hidden" name="answers" id="answers-input">

                <button type="button" id="back-btn" style="display: none;">Back</button>
                <button type="button" id="next-btn" style="display: none;">Next</button>
                <button type="submit" id="submit-btn" style="display: none;">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Mengambil data pertanyaan dan jawaban dari server
        let questions = [];
        let currentQuestionIndex = 0;
        let userAnswers = new Array(questions.length).fill(null); // Array untuk menyimpan jawaban pengguna

        // const initialModal = document.getElementById("initialModal");
        const quizModal = document.getElementById("quizModal");
        const openModalButton = document.getElementById("openModal");
        const proceedBtn = document.getElementById("proceed-btn");
        // const closeInitialModalBtn = initialModal.querySelector(".close-btn");
        const closeQuizModalBtn = quizModal.querySelector(".close-btn");
        const questionContainer = document.getElementById("question-container");
        const backBtn = document.getElementById("back-btn");
        const nextBtn = document.getElementById("next-btn");
        const submitBtn = document.getElementById("submit-btn");

        // Membuka modal awal
        openModalButton.addEventListener("click", (event) => {
            event.preventDefault();
            quizModal.classList.add("show");
        });

        // Melanjutkan ke kuis
        // proceedBtn.addEventListener("click", () => {
        //     initialModal.classList.remove("show");
        //     quizModal.classList.add("show");
        //     loadQuestion(currentQuestionIndex);
        // });

        // Menutup modal awal
        // closeInitialModalBtn.addEventListener("click", () => {
        //     initialModal.classList.remove("show");
        // });

        // Menutup modal kuis
        closeQuizModalBtn.addEventListener("click", () => {
            quizModal.classList.remove("show");
        });

        // Mengambil soal dan jawaban dari API
        function loadQuestionsFromAPI() {
            fetch('/survey') // Panggil API untuk mengambil soal dan jawaban
                .then(response => response.json())
                .then(data => {
                    questions = data.map(question => {
                        if (question.answers && question.answers.length > 0) {
                            const correctAnswer = question.answers.find(answer => answer.isCorrect);
                            return {
                                id: question.intQuestion_ID,
                                text: question.txtQuestion,
                                options: question.answers.map(answer => ({
                                    id: answer.intAnswer_ID,
                                    text: answer.txtAnswer
                                })),
                                answer: correctAnswer ? correctAnswer.intAnswer_ID :
                                    null // Menyimpan ID jawaban yang benar
                            };
                        }
                        return null; // Pastikan tidak ada soal tanpa jawaban
                    }).filter(question => question !== null); // Menghapus soal yang tidak valid

                    userAnswers = new Array(questions.length).fill(null); // Reset array jawaban pengguna
                    loadQuestion(currentQuestionIndex); // Memuat pertanyaan pertama
                })
                .catch(error => {
                    console.error("Error fetching questions:", error);
                });
        }

        // Memuat pertanyaan berdasarkan indeks
        //     function loadQuestion(index) {
        //         const question = questions[index];
        //         if (!question) return; // Pastikan soal ada sebelum mencoba memuatnya

        //         questionContainer.innerHTML = `
    //     <div class="question">
    //         <p><strong>${index + 1}. ${question.text}</strong></p>
    //         ${question.options
    //             .map(
    //                 (option, i) => {
    //                     const isChecked = userAnswers[index] === option.id.toString(); // Cek jika jawaban yang disimpan sama dengan ID opsi
    //                     return `
        //                                                     <div class="option">
        //                                                         <input
        //                                                             type="radio"
        //                                                             id="option${i}"
        //                                                             name="answer"
        //                                                             value="${option.id}"
        //                                                             ${isChecked ? "checked" : ""}>
        //                                                         <label for="option${i}">${option.text}</label>
        //                                                     </div>
        //                                                 `;
    //                 }
    //             )
    //             .join("")}
    //     </div>
    // `;

        //         // Tampilkan tombol "Back", "Next", dan "Submit"
        //         backBtn.style.display = index > 0 ? "inline-block" : "none";
        //         nextBtn.style.display = index < questions.length - 1 ? "inline-block" : "none";
        //         submitBtn.style.display = index === questions.length - 1 ? "inline-block" : "none";
        //     }


        function loadQuestion(index) {
            const question = questions[index];
            if (!question) return; // Pastikan soal ada sebelum mencoba memuatnya

            questionContainer.innerHTML = `
        <div class="question">
            <p><strong>${index + 1}. ${question.text}</strong></p>
            ${question.options
                .map(
                    (option, i) => {
                        const isChecked = userAnswers[index] === option.id.toString(); // Cek jika jawaban yang disimpan sama dengan ID opsi
                        return `
                                                            <div class="option">
                                                                <input
                                                                    type="radio"
                                                                    id="option${i}"
                                                                    name="answer"
                                                                    value="${option.id}"
                                                                    ${isChecked ? "checked" : ""}>
                                                                <label for="option${i}">${option.text}</label>
                                                            </div>
                                                        `;
                    }
                )
                .join("")}
        </div>
    `;

            // Tampilkan tombol "Back", "Next", dan "Submit"
            backBtn.style.display = index > 0 ? "inline-block" : "none";
            nextBtn.style.display = index < questions.length - 1 ? "inline-block" : "none";
            submitBtn.style.display = index === questions.length - 1 ? "inline-block" : "none";
        }

        // Menyimpan jawaban pengguna
        function saveAnswer() {
            const selectedOption = document.querySelector('input[name="answer"]:checked');
            if (selectedOption) {
                userAnswers[currentQuestionIndex] = selectedOption.value;
                console.log(userAnswers); // Debugging: Periksa isi array userAnswers
            }
        }

        // Validasi jawaban sebelum melanjutkan
        function validateAnswer() {
            const selectedOption = document.querySelector('input[name="answer"]:checked');
            if (!selectedOption) {
                alert("Please select an answer before proceeding!");
                return false;
            }
            saveAnswer();
            return true;
        }

        // Tombol "Next"
        nextBtn.addEventListener("click", () => {
            if (validateAnswer()) {
                currentQuestionIndex++;
                loadQuestion(currentQuestionIndex);
            }
        });

        // Tombol "Back"
        backBtn.addEventListener("click", () => {
            saveAnswer();
            currentQuestionIndex--;
            loadQuestion(currentQuestionIndex);
        });

        // Tombol "Submit"
        submitBtn.addEventListener("click", () => {
            if (validateAnswer()) {
                // Menghitung skor
                let score = 0;
                questions.forEach((question, index) => {
                    if (userAnswers[index] === question.answer) {
                        score++;
                    }
                });

                // Menyimpan jawaban pengguna ke server
                submitAnswersToServer();
                quizModal.classList.remove("show");
            }
        });

        function submitAnswersToServer() {
            // Map userAnswers ke format yang sesuai
            const answers = questions.map((question, index) => ({
                question_id: question.id,
                answer_id: userAnswers[index] // ID jawaban yang dipilih
            }));

            // Masukkan jawaban ke input hidden di form
            document.getElementById('answers-input').value = JSON.stringify(answers);

            // Kirimkan form
            document.getElementById('survey-form').submit();
        }
        // Memanggil fungsi untuk memuat soal saat halaman dimuat
        window.addEventListener('DOMContentLoaded', loadQuestionsFromAPI);
    </script>
@endsection
