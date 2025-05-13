document.getElementById('storyForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah reload halaman

    const storyInput = document.getElementById('storyInput').value;

    if (storyInput.trim() !== "") {
        // Membuat elemen baru untuk menampilkan cerita
        const newStory = document.createElement('p');
        newStory.textContent = storyInput;

        // Menambahkan cerita baru ke displayArea
        document.getElementById('displayArea').appendChild(newStory);

        // Kosongkan input setelah cerita ditambahkan
        document.getElementById('storyInput').value = "";
    } else {
        alert("Mohon masukkan cerita atau quotes terlebih dahulu!");
    }
});

