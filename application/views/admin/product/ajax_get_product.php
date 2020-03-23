<table class="table table-responsive Table">
<thead>
  <tr>
    <td>Sr. No.</td>
    <td>Title</td>
    <td>Image</td>
    <td>Short Description</td>
    <td>View Price</td>
    <td>Action</td>
  </tr>
  </thead>
  <tbody>
  <?php if(count($tours)){ $i = 0; foreach ($tours as $key => $product) { $i++; 
      $active = $product['ProductId'].",tblproduct,Product,"; ?>
    <tr>
      <td><?php echo '&nbsp;&nbsp;'.$i; ?></td>
      <td><?= $product['Title'] ?></td>
      <td><img src="<?= base_url(TOURPATH.$product['Image']) ?>" height="100" width="150"> </td>
      <td><?php 
          if(strlen($product['ShortDescription']) > 100) { 
            echo '<p>'.substr(strip_tags($product['ShortDescription']),0,100).'...</p>'; } else {
              echo $product['ShortDescription'];
          } ?></td>
      <td>
          <a href="<?= base_url(ADMIN.'Product/view_price/'.md5($product['ProductId'])) ?>" class="btn btn-success Approve" title="Click To View Price"><span class="fa fa-check-circle fa-cwarning"></span>&nbsp;&nbsp;View Price</a>
      </td>
      <td class="btnall">
        <a href="<?= base_url(ADMIN.'Product/add/'.md5($product['ProductId'])) ?>" class="btn btn-info btn-sm Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
        <a href="<?= base_url(ADMIN.'Product/DeleteRecord/'.base64_encode($active.ADMIN."Product")) ?>" class="btn btn-danger btn-sm Delete" onclick="return myconfirm();"><i class="fa fa-times"></i></a>&nbsp;&nbsp;
        <a href="<?= base_url(ADMIN.'Product/view/'.md5($product['ProductId'])) ?>" class="btn btn-success btn-sm View"><i class="fa fa-info-circle"></i></a>
      </td>
  </tr>
  <?php } } ?>
  </tbody>
</table>
<div class="row">
  <div class="col-md-12">
    <?php echo $this->ajax_pagination->create_links(); ?>
  </div>
</div>