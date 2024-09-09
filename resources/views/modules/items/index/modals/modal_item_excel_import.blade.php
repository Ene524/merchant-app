<div class="modal fade"
     id="itemExcelModal"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Excel'den Al</h4>
            </div>
            <div class="modal-body">

                <div id="error-container"></div>


                <form class="form-horizontal"
                      method="POST">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Adı</label>
                            <div class="col-sm-10">
                                <input type="file"
                                       name="file"
                                       id="file"
                                       id="exampleInputFile">
                            </div>
                            <p class="help-block">Excel dosyası xlsx formatında ve şablona uygun olmalıdır</p>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger"
                                    type="button"
                                    data-dismiss="modal">Vazgeç
                            </button>
                            <button class="btn btn-primary"
                                    type="button"
                                    id="saveFromExcel">Kaydet
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
