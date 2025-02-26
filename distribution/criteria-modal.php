  <!-- Modal Form (Filter Options) -->
  <div class="modal fade" id="ExtralargeModal" tabindex="-1" aria-labelledby="ExtralargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ExtralargeModalLabel">Criteria</h5>
                                                                <button type="button" class="btn btn-sm-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                                                                    <div class="row">

                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="farmerAddComparison" class="form-label">Farmer Address (Contains)</label>
                                                                                    <div class="input-group">
                                                                                            <select id="farmerAddComparison" name="farmerAddComparison" class="form-select">
                                                                                                <option value="farmer_brgy_address">Barangay</option>
                                                                                                <option value="farmer_municipality_address">Municipality</option>
                                                                                                <option value="farmer_province_address">Province</option>
                                                                                            </select>
                                                                                        <input type="text" id="farmerAdd" name="farmerAdd" class="form-control" placeholder="Enter">
                                                                                    </div>
                                                                            </div>

                                                                    </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="addItems" class="btn btn-sm btn-warning">Distribute</button>
                                                                </div>
                                                        </div>
                                                    </div>
                                            </div>