$(function(){
  // 全屏切换
  var $fullText = $('.admin-fullText');
  $('#admin-fullscreen').on('click', function() {
    $.AMUI.fullscreen.toggle();
  });
  $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function() {
    $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
  });
});

// 新窗口
function openwin(Url,Name){
  window.open(Url,Name,'width=800,height=600,scrollbars=yes,resizable=yes');
  return false;
}

// 获取草稿箱内容
function getLocalData(){
  alert(UE.getEditor('editor').execCommand("getlocaldata"));
}

// 清除草稿箱内容
function clearLocalData(){
  UE.getEditor('editor').execCommand("clearlocaldata");
  alert("已清空草稿箱")
}

// 高度满屏
// var height = $(window).height() - 115;
// $('.admin-content').height(height);