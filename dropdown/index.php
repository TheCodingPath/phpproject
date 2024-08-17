<?php
include 'db_connection.php';
// Fetch countries
$countries = $conn->query("SELECT * FROM countries");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dependent Select Box Dropdowns with PHP, AJAX and SQL</title>
    <meta name="description" content="Learn how to create dependent dropdowns using PHP, SQL, and JavaScript with easy-to-follow instructions and example code.">
</head>
<body>
    <h1>How to Create Dependent Dropdowns with PHP and JavaScript</h1>
    <form method="post">
        <label for="country">Select Country:</label>
        <select id="country" name="country_id">
            <option value="">Select Country</option>
            <?php while ($row = $countries->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="city">Select City:</label>
        <select id="city" name="city_id" disabled>
            <option value="">Select City</option>
        </select>

        <label for="area">Select Area:</label>
        <select id="area" name="area_id" disabled>
            <option value="">Select Area</option>
        </select>
    </form>

    <script>
        document.getElementById('country').addEventListener('change', function() {
            var countryId = this.value;
            var citySelect = document.getElementById('city');
            citySelect.disabled = true;
            citySelect.innerHTML = '<option value="">Select City</option>';

            if (countryId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_data.php?type=cities&country_id=' + countryId, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        citySelect.innerHTML += xhr.responseText;
                        citySelect.disabled = false;
                    }
                };
                xhr.send();
            }
        });

        document.getElementById('city').addEventListener('change', function() {
            var cityId = this.value;
            var areaSelect = document.getElementById('area');
            areaSelect.disabled = true;
            areaSelect.innerHTML = '<option value="">Select Area</option>';

            if (cityId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_data.php?type=areas&city_id=' + cityId, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        areaSelect.innerHTML += xhr.responseText;
                        areaSelect.disabled = false;
                    }
                };
                xhr.send();
            }
        });
    </script>
</body>
</html>
