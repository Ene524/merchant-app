<div class="modal fade"
     id="itemTransactionModal"
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
                <h4 class="modal-title">Item Hareketi Gir - {{$item->name}}</h4>
            </div>
            <div class="modal-body">
                <div id="error-transaction-container"></div>
                <form class="form-horizontal"
                      method="POST">
                    <div class="box-body">
                        <input type="hidden"
                               name="id"
                               id="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tip</label>
                            <div class="col-sm-10">
                                <select class="form-control"
                                        name="type"
                                        id="type">
                                    <option value="{{null}}">Seçiniz</option>
                                    <option value="1">Alış</option>
                                    <option value="2">Satış</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Miktarı</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                       type="number"
                                       name="quantity"
                                       onkeyup="calculatePrice()"
                                       id="quantity"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Fiyatı</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                       type="number"
                                       name="price"
                                       onkeyup="calculatePrice()"
                                       id="price"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Fiyatı Vergisiz</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                       type="number"
                                       name="price_with_vat"
                                       id="price_with_vat"
                                       disabled/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger"
                                    type="button"
                                    data-dismiss="modal">Vazgeç
                            </button>
                            <button class="btn btn-primary"
                                    type="button"
                                    id="saveItemTransaction">Kaydet
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
