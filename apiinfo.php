<?php require_once("inc/header.php"); ?>
<!-- Main variables *content* -->

<div class="inner-page">
  <section>
    <div class="container">
      <div class="row justify-content-center api-panel">
        <div class="col-lg-7">
          <div class="card accordion">
            <div class="card-header">
              <button class="btn top-title" type="button" data-toggle="collapse" data-target="#apiDoc" aria-expanded="true" aria-controls="collapseOne">
                API Dökümanları <i class="arrow fa fa-angle-up"></i><i class="arrow fa fa-angle-down"></i>
              </button>
            </div>
            <div id="apiDoc" class="collapse show">
              <table class="table">
                <tbody>
                  <tr>
                    <td>HTTP Method</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>API URL</td>
                    <td><a href="link"><? echo $takeSetting['url'];?>api/v2</a></td>
                  </tr>
                                    <tr>
                    <td>Response format</td>
                    <td>JSON</td>
                  </tr>
                                  <tr>

                      <td>Api Anahtari</td>
                    <td>  <?php if(isset($_SESSION['username'])){ echo $takeUserInfo['apikey'];}else{echo "Önce kayıt olmalısınız";}?></td>

                  </tr>
                </tbody>
              </table>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm footer-text">Örnekleri İndirin</div>
                  <div class="col-sm text-sm-right">
                    <a href="example.txt" class="btn btn-green" target="_blank">
                      <i class="fa fa-cloud-download-alt"></i> PHP Code
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>




                      <div class="card accordion">
              <div class="card-header">
                <button class="btn title" type="button" data-toggle="collapse" data-target="#service_services" aria-expanded="true">
                  Servis Litesi <i class="arrow fa fa-angle-up"></i><i class="arrow fa fa-angle-down"></i>
                </button>
              </div>


              <div id="service_services" class="card-body collapse show">
                                                  <table class="table table-sm">
                    <thead class="bg-green border border-success">
                    <tr>
                      <th class="width-40">Parametreler</th>
                      <th>Değerleri</th>
                    </tr>
                    </thead>
                    <tbody class="border border-top-0">
                                          <tr>
                        <td>key</td>
                        <td>Api Anahtarınız</td>
                      </tr>
                                          <tr>
                        <td>action</td>
                        <td>services</td>
                      </tr>
                                        </tbody>
                  </table>

                <div class="sub-title">Örnek cevap</div>
                <div class="card bg-light">
                  <div class="card-body">
                    <button class="float-right link" data-toggle="tooltip" data-placement="bottom" title="" onclick="CopyToClipboard('copyServiceListCode_services')" data-original-title="Copy code">
                      <i class="fa fa-copy"></i> Copy
                    </button>

<pre><code id="copyServiceListCode_services" class="language-json jsonData">[
    {
        <span class="token property">"service":</span> <span class="number">1</span>,
        <span class="token property">"name":</span> <span class="token operator">"Followers"</span>,
        <span class="token property">"type":</span> <span class="token operator">"Default"</span>,
        <span class="token property">"category":</span> <span class="token operator">"First Category"</span>,
        <span class="token property">"rate":</span> <span class="token operator">"0.90"</span>,
        <span class="token property">"min":</span> <span class="token operator">"50"</span>,
        <span class="token property">"max":</span> <span class="token operator">"10000"</span>
    },
    {
        <span class="token property">"service":</span> <span class="number">2</span>,
        <span class="token property">"name":</span> <span class="token operator">"Comments"</span>,
        <span class="token property">"type":</span> <span class="token operator">"Custom Comments"</span>,
        <span class="token property">"category":</span> <span class="token operator">"Second Category"</span>,
        <span class="token property">"rate":</span> <span class="token operator">"8"</span>,
        <span class="token property">"min":</span> <span class="token operator">"10"</span>,
        <span class="token property">"max":</span> <span class="token operator">"1500"</span>
    }
]</code>
</pre>

                  </div>
                </div>
              </div>
            </div>
                      <div class="card accordion">
              <div class="card-header">
                <button class="btn title" type="button" data-toggle="collapse" data-target="#service_add" aria-expanded="true">
                  Sipariş Ekle <i class="arrow fa fa-angle-up"></i><i class="arrow fa fa-angle-down"></i>
                </button>
              </div>


              <div id="service_add" class="card-body collapse show">

                    <form class="form-inline">
                      <div class="form-group">
                        <select class="form-control input-sm" id="service_type">
                                                      <option value="0">Default</option>
                                                      <option value="10">Package</option>
                                                      <option value="2">Custom Comments</option>
                                                      <option value="4">Mentions Custom List</option>
                                                      <option value="7">Mentions User Followers</option>
                                                      <option value="100">Subscriptions</option>
                                                  </select>
                      </div>
                    </form>

                                                                      <table class="table table-sm">

                    </table>
                                      <table class="table table-sm">
                      <thead class="bg-green border border-success">
                        <tr>
                          <th>Parametreler</th>
                          <th>Değerleri</th>
                        </tr>
                      </thead>
                      <tbody class="border border-top-0">
                                                  <tr>
                            <td>key</td>
                            <td>Your API key</td>
                          </tr>
                                                  <tr>
                            <td>action</td>
                            <td>add</td>
                          </tr>
                                                  <tr>
                            <td>service</td>
                            <td>Service ID</td>
                          </tr>
                                                  <tr>
                            <td>link</td>
                            <td>Link to page</td>
                          </tr>
                          <tr>
                      <td>quantity</td>
                      <td>Needed quantity</td>
                    </tr>
                                              </tbody>
                    </table>

                <div class="sub-title">Örnek cevap</div>
                <div class="card bg-light">
                  <div class="card-body">
                    <button class="float-right link" data-toggle="tooltip" data-placement="bottom" title="" onclick="CopyToClipboard('copyServiceListCode_add')" data-original-title="Copy code">
                      <i class="fa fa-copy"></i> Copy
                    </button>

<pre><code id="copyServiceListCode_add" class="language-json jsonData">{
    <span class="token property">"order":</span> <span class="number">23501</span>
}</code>
</pre>

                  </div>
                </div>
              </div>
            </div>
                      <div class="card accordion">
              <div class="card-header">
                <button class="btn title" type="button" data-toggle="collapse" data-target="#service_status" aria-expanded="true">
                  Sipariş durumu<i class="arrow fa fa-angle-up"></i><i class="arrow fa fa-angle-down"></i>
                </button>
              </div>


              <div id="service_status" class="card-body collapse show">
                                                  <table class="table table-sm">
                    <thead class="bg-green border border-success">
                    <tr>
                      <th class="width-40">Parametreler</th>
                      <th>Değerleri</th>
                    </tr>
                    </thead>
                    <tbody class="border border-top-0">
                                          <tr>
                        <td>key</td>
                        <td>Your API key</td>
                      </tr>
                                          <tr>
                        <td>action</td>
                        <td>status</td>
                      </tr>
                                          <tr>
                        <td>order</td>
                        <td>Order ID</td>
                      </tr>
                                        </tbody>
                  </table>

                <div class="sub-title">Örnek cevap</div>
                <div class="card bg-light">
                  <div class="card-body">
                    <button class="float-right link" data-toggle="tooltip" data-placement="bottom" title="" onclick="CopyToClipboard('copyServiceListCode_status')" data-original-title="Copy code">
                      <i class="fa fa-copy"></i> Copy
                    </button>

<pre><code id="copyServiceListCode_status" class="language-json jsonData">{
    <span class="token property">"charge":</span> <span class="token operator">"0.27819"</span>,
    <span class="token property">"start_count":</span> <span class="token operator">"3572"</span>,
    <span class="token property">"status":</span> <span class="token operator">"Partial"</span>,
    <span class="token property">"remains":</span> <span class="token operator">"157"</span>,
    <span class="token property">"currency":</span> <span class="token operator">"USD"</span>
}</code>
</pre>

                  </div>
                </div>
              </div>
            </div>

            <div class="card accordion">
              <div class="card-header">
                <button class="btn title" type="button" data-toggle="collapse" data-target="#service_multi_status" aria-expanded="true">
                  Çoklu sipariş durumu <i class="arrow fa fa-angle-up"></i><i class="arrow fa fa-angle-down"></i>
                </button>
              </div>


              <div id="service_multi_status" class="card-body collapse show">
                                                  <table class="table table-sm">
                    <thead class="bg-green border border-success">
                    <tr>
                      <th class="width-40">Parametreler</th>
                      <th>Değerleri</th>
                    </tr>
                    </thead>
                    <tbody class="border border-top-0">
                                          <tr>
                        <td>key</td>
                        <td>Your API key</td>
                      </tr>
                                          <tr>
                        <td>action</td>
                        <td>status</td>
                      </tr>
                                          <tr>
                        <td>orders</td>
                        <td>Order IDs separated by comma</td>
                      </tr>
                                        </tbody>
                  </table>

                <div class="sub-title">Örnek cevap</div>
                <div class="card bg-light">
                  <div class="card-body">
                    <button class="float-right link" data-toggle="tooltip" data-placement="bottom" title="" onclick="CopyToClipboard('copyServiceListCode_multi_status')" data-original-title="Copy code">
                      <i class="fa fa-copy"></i> Copy
                    </button>

<pre><code id="copyServiceListCode_multi_status" class="language-json jsonData">{
    <span class="token property">"1":</span> {
        <span class="token property">"charge":</span> <span class="token operator">"0.27819"</span>,
        <span class="token property">"start_count":</span> <span class="token operator">"3572"</span>,
        <span class="token property">"status":</span> <span class="token operator">"Partial"</span>,
        <span class="token property">"remains":</span> <span class="token operator">"157"</span>,
        <span class="token property">"currency":</span> <span class="token operator">"USD"</span>
    },
    <span class="token property">"10":</span> {
        <span class="token property">"error":</span> <span class="token operator">"Incorrect order ID"</span>
    },
    <span class="token property">"100":</span> {
        <span class="token property">"charge":</span> <span class="token operator">"1.44219"</span>,
        <span class="token property">"start_count":</span> <span class="token operator">"234"</span>,
        <span class="token property">"status":</span> <span class="token operator">"In progress"</span>,
        <span class="token property">"remains":</span> <span class="token operator">"10"</span>,
        <span class="token property">"currency":</span> <span class="token operator">"USD"</span>
    }
}</code>
</pre>

                  </div>
                </div>
              </div>
            </div>


                      <div class="card accordion">
              <div class="card-header">
                <button class="btn title" type="button" data-toggle="collapse" data-target="#service_balance" aria-expanded="true">
                  Kullanıcı Bakiye Sorgulama <i class="arrow fa fa-angle-up"></i><i class="arrow fa fa-angle-down"></i>
                </button>
              </div>


              <div id="service_balance" class="card-body collapse show">
                                                  <table class="table table-sm">
                    <thead class="bg-green border border-success">
                    <tr>
                      <th class="width-40">Parametreler</th>
                      <th>Değerleri</th>
                    </tr>
                    </thead>
                    <tbody class="border border-top-0">
                                          <tr>
                        <td>key</td>
                        <td>Your API key</td>
                      </tr>
                                          <tr>
                        <td>action</td>
                        <td>balance</td>
                      </tr>
                                        </tbody>
                  </table>

                <div class="sub-title">Örnek cevap</div>
                <div class="card bg-light">
                  <div class="card-body">
                    <button class="float-right link" data-toggle="tooltip" data-placement="bottom" title="" onclick="CopyToClipboard('copyServiceListCode_balance')" data-original-title="Copy code">
                      <i class="fa fa-copy"></i> Copy
                    </button>

<pre><code id="copyServiceListCode_balance" class="language-json jsonData">{
    <span class="token property">"balance":</span> <span class="token operator">"100.84292"</span>,
    <span class="token property">"currency":</span> <span class="token operator">"USD"</span>
}</code>
</pre>

                  </div>
                </div>
              </div>
            </div>
                  </div>
      </div>
    </div>
  </section>
</div>


<?php require_once("inc/footer.php"); ?>
