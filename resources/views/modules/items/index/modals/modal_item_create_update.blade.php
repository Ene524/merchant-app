<div class="modal fade"
     id="itemModal"
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
                <h4 class="modal-title">Item Gir</h4>
            </div>
            <div class="modal-body">

                <div id="error-container"></div>



                <form class="form-horizontal"
                      method="POST">
                    <div class="box-body">
                        <input type="hidden"
                               name="id"
                               id="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Adı</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                       type="text"
                                       name="name"
                                       id="name"
                                       required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Açıklaması</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                       type="text"
                                       name="description"
                                       id="description"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Notu</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                       type="text"
                                       name="note"
                                       id="note"/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger"
                                    type="button"
                                    data-dismiss="modal">Vazgeç
                            </button>
                            <button class="btn btn-primary"
                                    type="button"
                                    id="saveItem">Kaydet
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
