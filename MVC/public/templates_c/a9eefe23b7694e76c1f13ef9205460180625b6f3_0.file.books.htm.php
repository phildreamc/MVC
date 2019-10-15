<?php
/* Smarty version 3.1.33, created on 2019-10-14 07:46:12
  from 'C:\wamp\www\MVC\app\view\BookList\books.htm' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5da427c4859a01_97173858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9eefe23b7694e76c1f13ef9205460180625b6f3' => 
    array (
      0 => 'C:\\wamp\\www\\MVC\\app\\view\\BookList\\books.htm',
      1 => 1571039153,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header_noside.htm' => 1,
    'file:footer_noside.htm' => 1,
  ),
),false)) {
function content_5da427c4859a01_97173858 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header_noside.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!--借阅弹窗-->
<div class="modal modal-info fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">申请借阅？</h4>
      </div>
      <form action="" method="POST">
      <!-- <div class="modal-body"> -->
        <!-- 删除：<input style="color:gray" type="text" name="name" onkeyup="this.value=this.value.replace(/[^_a-zA-Z]/g,'')" placeholder="姓名"> -->
      <!-- </div> -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-outline">确定</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>书名</th>
                  <th>图片</th>
                  <th>图书分类</th>
                  <th>作者</th>
                  <th>已借阅次数</th>
                  <th>状态</th>
                  <th>借阅者</th>
                  <th>借书日期</th>
                  <th>还书期限</th>
                </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
?>
                <tr id="book_<?php echo $_smarty_tpl->tpl_vars['item']->value['book_id'];?>
">
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['book_name'];?>
</td>
                  <td><img style="width:100px;heiht:100px;" src="<?php echo $_smarty_tpl->tpl_vars['item']->value['book_pic'];?>
" /></td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['book_type'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['book_author'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['book_count'];?>
次</td>
                  <td id="book_<?php echo $_smarty_tpl->tpl_vars['item']->value['book_id'];?>
_button"><button type="button" <?php if ($_smarty_tpl->tpl_vars['item']->value['book_status'] == "可借阅") {?>onclick="apply(<?php echo $_smarty_tpl->tpl_vars['item']->value['book_id'];?>
)" <?php }?>class="btn btn-block <?php if ($_smarty_tpl->tpl_vars['item']->value['book_status'] == "可借阅") {?>btn-success<?php } elseif ($_smarty_tpl->tpl_vars['item']->value['book_status'] == "申请中") {?>btn-warning<?php } elseif ($_smarty_tpl->tpl_vars['item']->value['book_status'] == "待归还") {?>btn-danger<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['book_status'];?>
</button></td>
                  <td id="book_<?php echo $_smarty_tpl->tpl_vars['item']->value['book_id'];?>
_owner"><?php echo $_smarty_tpl->tpl_vars['item']->value['book_owner'];?>
</td>
                  <td id="book_<?php echo $_smarty_tpl->tpl_vars['item']->value['book_id'];?>
_bt"><?php echo $_smarty_tpl->tpl_vars['item']->value['book_bt'];?>
</td>
                  <td></td>
                </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>
<!-- page script -->
<?php echo '<script'; ?>
>

function apply(id) {
    $.ajax({
        type : "GET",
        url : "./../api/apply/" + id,
        success : function(result) {
            data = JSON.parse(result);
            if (data.code == 200) {
                var date = new Date();
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var datetime = year + "-" + month + "-" + day;
                $("#book_" + id + "_button").html('<button type="button" class="btn btn-block btn-warning">申请中</button>');
                $("#book_" + id + "_owner").html('test');
                $("#book_" + id + "_bt").html(datetime);
            }else {
                console.log(data.code);
            }
        },
        error : function(e){
            $r = false;
            alert('网络错误！');
        }
    });
}

<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender('file:footer_noside.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
