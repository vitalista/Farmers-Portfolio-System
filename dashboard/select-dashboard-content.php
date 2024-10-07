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
            <option value="Bagong Nayon">Bagong Nayon</option>
            <option value="Barangca">Barangca</option>
            <option value="Calantipay">Calantipay</option>
            <option value="Catulinan">Catulinan</option>
            <option value="Concepcion">Concepcion</option>
            <option value="Hinukay">Hinukay</option>
            <option value="Makinabang">Makinabang</option>
            <option value="Matang Tubig">Matang Tubig</option>
            <option value="Pagala">Pagala</option>
            <option value="Paitan">Paitan</option>
            <option value="Piel">Piel</option>
            <option value="Pinagbarilan">Pinagbarilan</option>
            <option value="Poblacion">Poblacion</option>
            <option value="Sabang">Sabang</option>
            <option value="San Jose">San Jose</option>
            <option value="San Roque">San Roque</option>
            <option value="Santa Barbara">Santa Barbara</option>
            <option value="Santo Cristo">Santo Cristo</option>
            <option value="Santo Niño">Santo Niño</option>
            <option value="Subic">Subic</option>
            <option value="Sulivan">Sulivan</option>
            <option value="Tangos">Tangos</option>
            <option value="Tarcan">Tarcan</option>
            <option value="Tiaong">Tiaong</option>
            <option value="Tibag">Tibag</option>
            <option value="Tilapayong">Tilapayong</option>
            <option value="Virgen delos Flores">Virgen delos Flores</option>
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
                case "Pagala":
                    window.location.href = "brgy.php";
                    break;
                case "Calantipay":
                    window.location.href = "brgy copy.php";
                    break;
                case "Baliwag":
                    window.location.href = "dashboard.php";
                    break;
                default:
                    alert('Invalid request');
                    break;
            }
        });
    });
</script>