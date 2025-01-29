<style>
    .select2-container .select2-selection--single {
        padding-bottom: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
    }
</style>

<div class="col-md-2 mb-3">
    <div class="input-group">
        <select id="brgy-pages" class="form-select">
            <option selected>Baliwag</option>
            <?php
            $brgys = getCountArray('farmers', 'farmer_brgy_address', 'id');
            foreach ($brgys as $brgy) {
            ?>
                <option value="<?= $brgy; ?>"><?= $brgy; ?></option>
            <?php
            }
            ?>
        </select>
        <button class="btn btn-primary" id="goButton">Go</button>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#brgy-pages').select2({
            placeholder: "Select a page",
            // allowClear: true
        });

        $('#goButton').on('click', function() {
            const selectedValue = $('#brgy-pages').val();
            switch (selectedValue) {
                case "Main":
                    window.location.href = "dashboard.php";
                    break;
                default:
                    window.location.href = `brgy.php?brgy=${selectedValue}`;
                    break;
            }
        });
    });
</script>