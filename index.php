<?php
header("Access-Control-Allow-Origin: *");
include "./config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Speech Antrean</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">
        <h2>Buat Speech Antrean</h2>

        <!-- Form -->
        <!-- Combo Box -->
        <form>
            <div class="mb-3">
                <label for="description" class="form-label">Keterangan </label>
                <select class="form-select" id="description" required>
                    <option value="">-- Pilih Keterangan --</option>
                    <option value="Loket Pendaftaran">Loket Pendaftaran</option>
                    <option value="Ruang Pemeriksaan">Ruang Pemeriksaan</option>
                    <option value="Loket Farmasi">Loket Farmasi</option>
                    <option value="Loket Kasir">Loket Kasir</option>
                </select>
            </div>

            <!-- Input Text -->
            <div class="mb-3">
                <label for="number" class="form-label">Nomor Urutan</label>
                <input type="text" class="form-control" id="number" placeholder="Contoh : 001" maxlength="3">
            </div>

            <audio id="myAudio" controls>
                <source id="audioSource" type="audio/mpeg">
            </audio>
            <!-- Tombol Submit -->
            <button type="button" class="btn btn-primary" id="playButton">Buat</button>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        var audio = document.getElementById("myAudio");
        var source = document.getElementById("audioSource");

        function playAudio(filePath) {
            // Set the source file dynamically
            source.src = filePath;
            audio.load(); // Reload the audio element to apply the changes

            // Wait for the canplay event before playing
            audio.addEventListener('canplay', function() {
                audio.play(); // Play the audio
            }, false);
        }

        function fetchAndPlayAudio() {
            // Assuming you have input fields with ids 'descriptionInput' and 'numberInput'
            var description = $("#description").val();
            var number = $("#number").val();

            $.ajax({
                type: "POST",
                url: "generate.php", // Assuming your PHP script is named generate.php
                data: {
                    description: description,
                    number: number
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var filePath = data.file_path;

                    // Call the playAudio function with the retrieved file path
                    playAudio(filePath);
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        }


        function scheduleReplay() {
            setTimeout(function() {
                fetchAndPlayAudio();
                scheduleReplay(); // Schedule the next replay after 5 seconds
            }, 5000); // 5000 milliseconds = 5 seconds
        }

        // Initial play
        fetchAndPlayAudio();

        // Schedule replay after the audio ends
        audio.addEventListener("ended", function() {
            scheduleReplay();
        });

        // Handle button click
        $("#playButton").on("click", function() {
            fetchAndPlayAudio();
        });
    });
</script>

</html>