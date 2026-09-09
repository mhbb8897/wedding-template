document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".heading");
    document.querySelector(".location");

    // Modal, animation, and audio elements
    const modalContainer = document.getElementById('modal-container');
    const btnClose = document.getElementById('btn-close');
    const modal = document.querySelector('.relative');
    const audio = document.getElementById('myAudio');
    const disc = document.getElementById("audio-disc");

    // Ambil elemen nama pengantin
    const fera = document.getElementById('fera');
    const tawing = document.getElementById('tawing');

    // Tombol Buka Undangan
    if (btnClose) {
      btnClose.addEventListener('click', function () {
        // 1. Mulai proses penutupan modal
        modalContainer.classList.add('closing');

        // 2. Memutar audio dan menjalankan animasi piringan hitam (jika ada)
        if (audio) {
          audio.play().catch(e => console.log("Audio autoplay blocked:", e));
        }
        if (disc) {
          disc.classList.add("spinning");
        }

        // 3. Memicu animasi nama pengantin
        if (fera) {
          fera.classList.remove('opacity-0');
          fera.classList.add('play-animate-left');
        }
        if (tawing) {
          tawing.classList.remove('opacity-0');
          tawing.classList.add('play-animate-right');
        }

        // 4. Hapus modal setelah animasi tutup selesai
        setTimeout(() => {
          modalContainer.style.display = 'none';
          if (modal) modal.remove();
        }, 1000);
      });
    }

    // Cek Local Storage untuk batas 1x submit
    const submitButton = document.querySelector(".submit-btn");
    const nameForm = document.getElementById('name');
    const noteForm = document.getElementById('note');
    const formElement = document.querySelector('form');

    if (localStorage.getItem("hasSubmitted")) {
      disableForm();
    }

    // Submit notes menggunakan AJAX (Fetch API) tanpa refresh
    if (formElement) {
      formElement.addEventListener("submit", function (e) {
        e.preventDefault(); // Mencegah halaman melakukan refresh default

        const noteContent = noteForm.value.trim();
        const nameContent = nameForm.value.trim();

        if (!noteContent || !nameContent) {
          alert("Mohon lengkapi isi nama dan pesan");
          return;
        }

        const data = {
          name: nameContent,
          message: noteContent,
        };

        const formAction = formElement.getAttribute('action');
        const csrfTokenInput = document.querySelector('input[name="_token"]');
        const csrfToken = csrfTokenInput ? csrfTokenInput.value : '';

        fetch(formAction, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            "Accept": "application/json"
          },
          body: JSON.stringify(data),
        })
          .then((response) => response.json())
          .then((res) => {
            console.log("Success:", res);

            alert("Terimakasih atas pesannya!");

            // Set Local Storage untuk menandai bahwa pesan sudah dikirim
            localStorage.setItem("hasSubmitted", "true");

            // Tambahkan ucapan baru secara mandiri ke DOM tanpa refresh
            const notesContainer = document.querySelector('.notes');

            if (notesContainer) {
              const firstChildText = notesContainer.querySelector('.text-xl');
              if (firstChildText && firstChildText.textContent.includes("Belum ada ucapan")) {
                notesContainer.innerHTML = '';
              }

              const newWishHTML = `
                <div class="flex flex-col border-2 rounded-md p-1 bg-base border-white">
                    <h2 class="font-bold text-xl text-white">${escapeHtml(nameContent)}</h2>
                    <p class="text-white text-sm">${escapeHtml(noteContent)}</p>
                </div>
              `;
              notesContainer.insertAdjacentHTML('afterbegin', newWishHTML);
            }

            // Disable form setelah berhasil
            disableForm();
          })
          .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat mengirim pesan.");
          });
      });
    }

    // Fitur Salin Nomor Rekening
    const copyButtons = document.querySelectorAll(".copy-text");

    copyButtons.forEach(button => {
      button.addEventListener("click", function () {
        const textToCopy = this.getAttribute("data-copy");

        if (textToCopy) {
          navigator.clipboard.writeText(textToCopy).then(() => {
            const originalText = this.textContent;
            this.textContent = "Berhasil Disalin!";
            setTimeout(() => {
              this.textContent = originalText;
            }, 2000);
          }).catch(err => {
            console.error('Gagal menyalin: ', err);
            alert('Gagal menyalin teks.');
          });
        }
      });
    });
});

// Fungsi untuk Play / Pause saat disc diklik
function toggleAudio() {
  const audio = document.getElementById('myAudio');
  const disc = document.getElementById("audio-disc");
  if (audio && disc) {
    if (audio.paused) {
      audio.play();
      disc.classList.add("spinning");
    } else {
      audio.pause();
      disc.classList.remove("spinning");
    }
  }
}

function disableForm() {
  const submitButton = document.querySelector(".submit-btn");
  const nameForm = document.getElementById('name');
  const noteForm = document.getElementById('note');

  if (nameForm) {
    nameForm.disabled = true;
    nameForm.value = "";
  }
  if (noteForm) {
    noteForm.disabled = true;
    noteForm.value = "";
  }
  if (submitButton) {
    submitButton.disabled = true;
    submitButton.style.cursor = "auto";
  }
}

// Fungsi helper kecil untuk keamanan XSS sederhana pada input teks
function escapeHtml(text) {
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}