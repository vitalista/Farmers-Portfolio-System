<style>
    .select2-container .select2-selection--single {
        padding-bottom: 30px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 30px;
    }
</style>

<div class="col-md-4 mb-3">
    <div class="input-group w-50">
        <select id="brgy-pages" class="form-select form-select-sm">
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
        <button class="btn btn-primary btn-sm" id="goButton"><i class="bi bi-arrow-right"></i></button>
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
                case "Baliwag":
                    window.location.href = "dashboard.php";
                    break;
                default:
                    window.location.href = `brgy.php?brgy=${selectedValue}`;
                    break;
            }
        });
    });
</script>