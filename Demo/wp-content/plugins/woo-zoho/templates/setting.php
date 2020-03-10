<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                         
 ?><h3><?php echo sprintf(__("Account ID# %d",'woo-zoho'),$id);
if($new_account_id != $id){
 ?> <a href="<?php echo $new_account ?>" title="<?php _e('Add New Account','woo-zoho'); ?>" class="add-new-h2"><?php _e("Add New Account",'woo-zoho'); ?></a> 
 <?php
}
$name=$this->post('name',$info);    
 ?>
 <a href="<?php echo $link ?>" class="add-new-h2" title="<?php _e('Back to Accounts','woo-zoho'); ?>"><?php _e('Back to Accounts','woo-zoho'); ?></a></h3>
  <div class="crm_fields_table">
    <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_name"><?php _e("Account Name",'woo-zoho'); ?></label>
  </div>
  <div class="crm_field_cell2">
  <input type="text" name="crm[name]" value="<?php echo !empty($name) ? $name : 'Account #'.$id; ?>" id="vx_name" class="crm_text">

  </div>
  <div class="clear"></div>
  </div>

    <div class="crm_field">
  <div class="crm_field_cell1">
  <label for="vx_dc"><?php _e('Data Center','woocommece-zoho-crm'); ?></label>
  </div>
  <div class="crm_field_cell2">
<select name="crm[dc]" class="crm_text" id="vx_dc" data-save="no" <?php if( !empty($info['access_token'])){ echo 'disabled="disabled"'; } ?> >
  <?php $envs=array(
  'com'=>__('zoho.com (Global - USA)','woocommece-zoho-crm'),
  'eu'=>__('zoho.eu (Europe)','woocommece-zoho-crm'),
  'in'=>__('zoho.in (India)','woocommece-zoho-crm'),
  'com.cn'=>__('zoho.com.cn (China)','woocommece-zoho-crm'),
  'com.au'=>__('zoho.com.au (Australia)','woocommece-zoho-crm'),
  );
foreach($envs as $k=>$v){
    $sel='';
if(!empty($info['dc']) && $info['dc'] == $k){ $sel='selected="selected"'; }
echo '<option value="'.$k.'" '.$sel.'>'.$v.'</option>';
}
 ?>
 </select>
  </div>
  <div class="clear"></div>
  </div>
  <script type="text/javascript">
  jQuery(document).ready(function($){
  /*  $('#vx_dc').change(function(){
        var val=$(this).val();
        var btn=$('.sf_login');
      var url='https://accounts.zoho.'+val+'/';
      var dc=btn.attr('data-url');  
  btn.attr('href',url+dc); 
    })*/
    var elem=$('#mainform');
    var form=elem.serialize();
      $('.sf_login').click(function(e){
      var form2=elem.serialize(); 
      if(form != form2){
         e.preventDefault();
        alert('Please "Save Changes" first');  
      }
      });  
  })
  </script>
  <div class="crm_field">
  <div class="crm_field_cell1">
  <label for="vx_type"><?php _e('Zoho Service','woocommece-zoho-crm'); ?></label>
  </div>
  <div class="crm_field_cell2">
<select name="crm[type]" class="crm_text" id="vx_type" <?php if( !empty($info['access_token'])){ echo 'disabled="disabled"'; } ?> >
  <?php $envs=array(
  ''=>__('Zoho CRM','woocommece-zoho-crm'),
  'invoices'=>__('Zoho Invoice','woocommece-zoho-crm'),
  'books'=>__('Zoho Books','woocommece-zoho-crm'),
  'inventory'=>__('Zoho Inventory','woocommece-zoho-crm'),
  );
foreach($envs as $k=>$v){
    $sel='';
if(!empty($info['type']) && $info['type'] == $k){ $sel='selected="selected"'; }
echo '<option value="'.$k.'" '.$sel.'>'.$v.'</option>';
}
 ?>
 </select>
  </div>
  <div class="clear"></div>
  </div>
<div class="crm_field">
  <div class="crm_field_cell1"><label><?php _e('Zoho Access','woocommece-zoho-crm'); ?></label></div>
  <div class="crm_field_cell2">
  <?php if(isset($info['access_token'])  && $info['access_token']!="") {
  ?>
  <div style="padding-bottom: 8px;" class="vx_green"><i class="fa fa-check"></i> <?php
  echo sprintf(__("Authorized Connection to %s on %s",'woocommece-zoho-crm'),'<code>Zoho</code>',date('F d, Y h:i:s A',$info['_time']));
?></div><?php
  }else{
      $ret=$link.'&'.$this->id."_tab_action=get_token&vx_action=redirect&id=".$id."&vx_nonce=".$nonce;
$dc=!empty($info['dc']) ? $info['dc'] : 'com';
$ret_dc=$ret.'&dc='.$dc;
$scope='ZohoCRM.modules.ALL,ZohoCRM.settings.ALL,ZohoCRM.users.Read,ZohoCRM.coql.READ';
if(!empty($info['type'])){
    if($info['type'] == 'invoices'){
$scope='ZohoInvoice.invoices.ALL,ZohoInvoice.contacts.ALL,ZohoInvoice.settings.ALL,ZohoInvoice.estimates.ALL,ZohoInvoice.expenses.ALL,ZohoInvoice.projects.ALL,ZohoInvoice.creditnotes.ALL,ZohoInvoice.customerpayments.ALL';
}else if($info['type'] == 'books'){
$scope='ZohoBooks.fullaccess.all';
}else if($info['type'] == 'inventory'){
$scope='ZohoInventory.FullAccess.all';
} 
}
      $auth_url='oauth/v2/auth?scope='.$scope.'&response_type=code&client_id='.$client['client_id'].'&access_type=offline&redirect_uri='.urlencode($client['call_back']);

$ac_url=$api->ac_url();      
?>
  <a class="button button-default button-hero sf_login" data-id="<?php echo esc_html($client['client_id']) ?>" href="<?php echo $ac_url.$auth_url.'&state='.urlencode($ret_dc) ?>"  data-state="<?php echo urlencode($ret); ?>" data-url="<?php echo $auth_url ?>"  title="<?php _e("Login with Zoho",'woocommece-zoho-crm'); ?>" > <i class="fa fa-lock"></i> <?php _e("Login with Zoho",'woocommece-zoho-crm'); ?></a>
  
  <?php 
if(!empty($info['error'])){
 ?><div style="border-left: 4px solid #d00000; background: #fff; padding: 12px; margin-top: 12px;"><i class="fa fa-times"></i> <?php echo $info['error']; ?></div><?php   
}
  } ?>
  </div>
  <div class="clear"></div>
  </div>                  
<?php if(isset($info['access_token'])  && $info['access_token']!="") { ?>
<div class="crm_field">
  <div class="crm_field_cell1"><label><?php _e("Revoke Access",'woocommece-zoho-crm'); ?></label></div>
  <div class="crm_field_cell2">  <a class="button button-secondary" id="vx_revoke" href="<?php echo $link."&".$this->id."_tab_action=get_token&vx_nonce=".$nonce.'&id='.$id?>"><i class="fa fa-unlock"></i> <?php _e("Revoke Access",'woocommece-zoho-crm'); ?></a>
  </div>
  <div class="clear"></div>
  </div> 
<?php } ?>
 
  <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_custom_app_check"><?php _e("Zoho Client",'woo-zoho'); ?></label></div>
  <div class="crm_field_cell2"><div><label for="vx_custom_app_check"><input type="checkbox" name="crm[custom_app]" id="vx_custom_app_check" value="yes" <?php if($this->post('custom_app',$info) == "yes"){echo 'checked="checked"';} ?>><?php echo sprintf(__('Use Own Zoho App - If you want to connect one Zoho accounts to multiple sites then use a separate Zoho App for each site. %sView ScreenShots%s ','woo-zoho'),'<a href="https://www.crmperks.com/create-zoho-app-for-connecting-wordpress/" target="_blank">','</a>'); ?></label></div>
  </div>
  <div class="clear"></div>
  </div>

<div id="vx_custom_app_div" style="<?php if($this->post('custom_app',$info) != "yes"){echo 'display:none';} ?>">
     <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_id"><?php _e("Client ID",'woo-zoho'); ?></label></div>
  <div class="crm_field_cell2">
     <div class="vx_tr">
  <div class="vx_td">
  <input type="password" id="app_id" name="crm[app_id]" class="crm_text" placeholder="<?php _e("Zoho Client ID",'woo-zoho'); ?>" value="<?php echo esc_html($this->post('app_id',$info)); ?>">
  </div><div class="vx_td2">
  <a href="#" class="button vx_toggle_btn vx_toggle_key" title="<?php _e('Toggle Consumer Key','woo-zoho'); ?>"><?php _e('Show Key','woo-zoho') ?></a>
  
  </div></div>
  
    <div class="howto">
  <ol>
  <li><?php echo sprintf(__('Create New Client %shere%s','woo-zoho'),'<a href="https://accounts.zoho.com/developerconsole" target="_blank">','</a>'); ?></li>
  <li><?php _e('Enter Client Name(eg. My App)','woo-zoho'); ?></li>
  <li><?php echo sprintf(__('Enter %s or %s in Redirect URI','woo-zoho'),'<code>https://www.crmperks.com/google_auth/</code>','<code>'.$link."&".$this->id.'_tab_action=get_code</code>'); ?>
  </li>
<li><?php _e('Select Client Type as "Web Based"','woo-zoho'); ?></li>
<li><?php _e('Save Application','woo-zoho'); ?></li>
<li><?php echo __('Copy Client Id and Secret','woo-zoho'); ?></li>
   </ol>
  </div>
  
</div>
  <div class="clear"></div>
  </div>
     <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_secret"><?php _e("Client Secret",'woo-zoho'); ?></label></div>
  <div class="crm_field_cell2">
       <div class="vx_tr" >
  <div class="vx_td">
 <input type="password" id="app_secret" name="crm[app_secret]" class="crm_text"  placeholder="<?php _e("Zoho Client Secret",'woo-zoho'); ?>" value="<?php echo esc_html($this->post('app_secret',$info)); ?>">
  </div><div class="vx_td2">
  <a href="#" class="button vx_toggle_btn vx_toggle_key" title="<?php _e('Toggle Consumer Secret','woo-zoho'); ?>"><?php _e('Show Key','woo-zoho') ?></a>
  
  </div></div>
  </div>
  <div class="clear"></div>
  </div>
       <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_url"><?php _e("Zoho Client Redirect URL",'woo-zoho'); ?></label></div>
  <div class="crm_field_cell2"><input type="text" id="app_url" name="crm[app_url]" class="crm_text" placeholder="<?php _e("Zoho Client Redirect URL",'woo-zoho'); ?>" value="<?php echo esc_html($this->post('app_url',$info)); ?>"> 

  </div>
  <div class="clear"></div>
  </div>
  </div>

 <div class="crm_field">
  <div class="crm_field_cell1"><label><?php _e("Test Connection",'woocommece-zoho-crm'); ?></label></div>
  <div class="crm_field_cell2">      <button type="submit" class="button button-secondary" name="vx_test_connection"><i class="fa fa-refresh"></i> <?php _e("Test Connection",'woocommece-zoho-crm'); ?></button>
  </div>
  <div class="clear"></div>
  </div> 
  <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_error_email"><?php _e("Notify by Email on Errors",'woo-zoho'); ?></label></div>
  <div class="crm_field_cell2"><textarea name="crm[error_email]" id="vx_error_email" placeholder="<?php _e("Enter comma separated email addresses",'woo-zoho'); ?>" class="crm_text" style="height: 70px"><?php echo isset($info['error_email']) ? $info['error_email'] : ""; ?></textarea>
  <span class="howto"><?php _e("Enter comma separated email addresses. An email will be sent to these email addresses if an order is not properly added to Salesforce. Leave blank to disable.",'woo-zoho'); ?></span>
  </div>
  <div class="clear"></div>
  </div>   


  <button type="submit" value="save" class="button-primary" title="<?php _e('Save Changes','woo-zoho'); ?>" name="save"><?php _e('Save Changes','woo-zoho'); ?></button>  
  </div>  

  <script type="text/javascript">

  jQuery(document).ready(function($){


  $(".vx_tabs_radio").click(function(){
  $(".vx_tabs").hide();   
  $("#tab_"+this.id).show();   
  }); 
$(".sf_login").click(function(e){
    if($("#vx_custom_app_check").is(":checked")){
    var client_id=$(this).data('id');
    var new_id=$("#app_id").val();
    if(client_id!=new_id){
          e.preventDefault();   
     alert("<?php _e('Zoho Client ID Changed.Please save new changes first','woo-zoho') ?>");   
    }    
    }
})
  $("#vx_custom_app_check").click(function(){
     if($(this).is(":checked")){
         $("#vx_custom_app_div").show();
     }else{
            $("#vx_custom_app_div").hide();
     } 
  });
    $(document).on('click','#vx_revoke',function(e){
  
  if(!confirm('<?php _e('Notification - Remove Connection?','woo-zoho'); ?>')){
  e.preventDefault();   
  }
  })   
  })
  </script>  