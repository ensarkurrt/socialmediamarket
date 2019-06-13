<?php require_once("inc/header.php"); ?>
<!-- Main variables *content* -->
<div class="inner-page">
  <section>
    <div class="container">
      <div class="row justify-content-center payments-panel ticket-panel">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">

              <form method="post" id="ticketsend">
                <div class="alert alert-dismissible alert-danger" id="danger" style="display:none">
                  Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                </div>
                <div class="alert alert-dismissible alert-success" id="success" style="display:none">
                  Sipariş verildi. <a>Siparişlerim</a> sayfasından görüntüleyebilirsiniz.
                </div>

                <div class="form-group subject-panel">
                    <label for="subject">Konu</label>
                    <div class="row">
                      <div class="col">
                        <span class="custom-control">
                          <input type="radio" class="custom-control-input subject ticket-options" id="subjectOrder" name="ticketType" onclick="clickRadio(this)" value="Sipariş" checked>
                          <label class="custom-control-label" for="subjectOrder">Sipariş</label>
                        </span>
                      </div>
                      <div class="col">
                        <span class="custom-control">
                          <input type="radio" class="custom-control-input subject ticket-options" id="subjectPayment" name="ticketType" onclick="clickRadio(this)" value="Ödeme">
                          <label class="custom-control-label" for="subjectPayment">Ödeme</label>
                        </span>
                      </div>
                      <div class="col">
                        <span class="custom-control">
                          <input type="radio" class="custom-control-input subject ticket-options" id="subjectService" name="ticketType" onclick="clickRadio(this)" value="Servisler">
                          <label class="custom-control-label" for="subjectService">Servisler</label>
                        </span>
                      </div>
                      <div class="col">
                        <span class="custom-control">
                          <input type="radio" class="custom-control-input subject ticket-options" id="subjectOther" name="ticketType" onclick="clickRadio(this)" value="Diğer">
                          <label class="custom-control-label" for="subjectOther">Diğer</label>
                        </span>
                      </div>
                    </div>
                  </div>

                <div class="form-group ordernumbers" id="orderNum" style="display:block">
                    <label for="ordernumbers">Sipariş Numarası : </label>
                    <input id="orderNumInput" type="text" class="form-control" placeholder="Sipariş Numarası Olmayan Destek Talepleri Cevaplanmayacaktır.">
                  </div>

                  <div class="form-group ordernumbers">
                      <label for="ordernumbers">Başlık : </label>
                      <input id="konuInput" type="text" class="form-control" placeholder="Kısaca belirtiniz">
                    </div>
                <div class="form-group">
                  <label for="message" class="control-label">Mesaj</label>
                  <textarea class="form-control" rows="7" id="messageInput" placeholder="Destek talebinizi uzun uzun açıklayın"></textarea>
                </div>
                <input type="button" onclick="return newTicket()" name="save" class="btn btn-green" value="Destek Bildirimi Aç">
              </form>

              <!-- ord -->
            <!--  <form  method="post" action="" id="ticketsend">
            <div class="alert alert-dismissible alert-danger ticket-danger " style="display: none">
              <button type="button" class="close">&times;</button>
              <div></div>
            </div>
          <div class="form-group">
            <label for="subject" class="control-label">Konu</label>
            <select id="subject" class="subject form-control" name="TicketForm[subject]" onchange="generateVariable()" style="width:100%;height:40px;">
              <option value="Order">Sipariş</option>
              <option value="Payment">Ödeme</option>
              <option value="Service">Servisler</option>
              <option value="Other">Diğer</option>
              <option value="Suggestion">Öneri</option>
            </select>
          </div>

          <div class="form-group ordernumbers">
            <label for="ordernumbers" class="control-label">Order ID: </label><br><label style="font-weight:normal;">(For multiple orders, please separate them using comma. (example: 12345,12345,12345))</label>
            <input ID="ordernumbers" type="text" class="form-control" onkeyup="generateVariable()">
          </div>

          <div class="form-group type">
          	<label for="type" class="control-label">Request</label><br>
          	<select class="form-control" id="type" onchange="generateVariable()" style="width:100%;height:40px;">
              <option value="Refill">Refill</option>
              <option value="Cancellation">Cancellation (Only after 5 days if order is stucked)</option>
              <option value="Speed Up">Speed Up</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="form-group payment" style="display:none;">
          	<label for="payment" class="control-label">Payment</label><br>
          	<select class="form-control" id="payment" onchange="generateVariable()" style="width:100%;height:40px;">
              <option value="Paypal">Paypal</option>
              <option value="Perfect Money">Perfect Money</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label for="message" class="control-label">Mesaj</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" onkeyup="generateVariable()"></textarea>
          </div>
          <input type="hidden" name="_csrf" value="CiEbh9eLQK1sYImHqHGmkXj7v7VkGnwnkTzwbdVTh0pfUUPrhO8ynDMs8N_dAvKlHpaPjAApGmqgcKRevSvtDQ==">
          <input type="hidden" name="TicketForm[message]" id="alldata">
          <button type="submit" class="btn btn-green">Destek Bildirimi Aç</button>
        </form> -->

          </div>
          </div>

                      <div class="card my-orders-panel dripfeed-panel" style="overflow-y:auto;height:300px;">
              <div class="card-body">
                <table class="table ">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Konu</th>
                    <th>Durum</th>
                    <th class="nowrap">Oluşturuldu</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php
                          $tickets=$db->prepare("SELECT * FROM tickets where owner_id=:owner_id ORDER BY id DESC");
                          $tickets->execute(array(
                            'owner_id' => $takeUserInfo['id']
                          ));

                          while($takeTickets=$tickets->fetch(PDO::FETCH_ASSOC)){ ?>
                              <tr>
                                <td><?php echo $takeTickets['id']; ?></td>
                                <td><a href="ticketview-<?php echo $takeTickets['id']; ?>"><?php echo $takeTickets['subject']; ?></a></td>
                                <td><?php echo $takeTickets['stats']; ?></td>
                                <td><span class="nowrap"><?php echo tarihcek($takeTickets,'createTime'); ?></span></td>
                              </tr>
                        <?php  }  ?>

                                    </tbody>
                </table>
              </div>
            </div>
                  </div>
      </div>
    </div>
  </section>
</div>

<?php require_once("inc/footer.php"); ?>
