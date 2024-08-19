<?php
//Template Name:Listing2


?>
<form id="searchforms" method="post" action="">
<div class="row">
    <?php
    $min_prices = array(
        '1000' => '$1,000',
        '2000' => '$2,000',
        '3000' => '$3,000',
        '4000' => '$4,000',
        '5000' => '$5,000',
    );
    $max_prices = array(
        '1000' => '$1,000',
        '2000' => '$2,000',
        '3000' => '$3,000',
        '4000' => '$4,000',
        '5000' => '$5,000',
    );
    ?>
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="form-row">
            <label for="min">Minimum Price</label>
            <select id="min" class="form-control" onchange="updateMaxPrices()">
                <option value="" disabled selected>Select Minimum Price</option>
                <?php foreach($min_prices as $value => $min_price): ?>
                    <option value="<?php echo $value; ?>"><?php echo $min_price; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="form-row">
            <label for="max">Maximum Price</label>
            <select id="max" class="form-control">
                <option value="" disabled selected>Select Maximum Price</option>
                <?php foreach($max_prices as $value => $max_price): ?>
                    <option value="<?php echo $value; ?>"><?php echo $max_price; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>





            </form>

    <script>
        // Function to update the max price dropdown based on the selected min price
        function updateMaxPrices() {
            let minPrice = parseInt(document.getElementById('min').value);
            let maxDropdown = document.getElementById('max');
            let options = maxDropdown.getElementsByTagName('option');

            for (let i = 0; i < options.length; i++) {
                if (options[i].value !== "" && parseInt(options[i].value.replace(/,/g, '')) <= minPrice) {
                    options[i].disabled = true;
                } else {
                    options[i].disabled = false;
                }
            }

            // Reset the selected max price if it's less than the min price
            if (parseInt(maxDropdown.value.replace(/,/g, '')) <= minPrice) {
                maxDropdown.value = "";
            }
        }

        // Function to update the min price dropdown based on the selected max price
        function updateMinPrices() {
            let maxPrice = parseInt(document.getElementById('max').value.replace(/,/g, ''));
            let minDropdown = document.getElementById('min');
            let options = minDropdown.getElementsByTagName('option');

            for (let i = 0; i < options.length; i++) {
                if (options[i].value !== "" && parseInt(options[i].value) >= maxPrice) {
                    options[i].disabled = true;
                } else {
                    options[i].disabled = false;
                }
            }

            // Reset the selected min price if it's greater than the max price
            if (parseInt(minDropdown.value) >= maxPrice) {
                minDropdown.value = "";
            }
        }

        // Add event listeners to update dropdowns when selection changes
        document.getElementById('min').addEventListener('change', function() {
            updateMaxPrices();
        });
        document.getElementById('max').addEventListener('change', function() {
            updateMinPrices();
        });
    </script>