var dialog = {
    // 错误弹出层
    error: function(message) {
        layer.open({
            content:message,
            icon:2,
            title : '错误提示',
        });
    },

    //成功弹出层
    success : function(message,url) {
        layer.open({
            content : message,
            icon : 1,
            yes : function(){
                location.href=url;
            },
        });
    },

    // 确认弹出层
    confirm : function(message, url) {
        layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(){
                location.href=url;
            },
        });
    },

    //无需跳转到指定页面的确认弹出层
    toconfirm : function(message) {
        layer.open({
            content : message,
            icon:3,
            btn : ['确定'],
        });
    },
}

/**
 * 点击删除单个
 */
$('body').on("click", '.to-delete-btn', function(e){
	var href = $(this).attr("data-href");
	var content = $(this).attr('data-content') || '您确定要删除吗?';
	layer.open({content : content,icon : 3,btn : ['是','否'],yes : function(){ location.href = href; } });
});

/**
 * 点击批量删除
 */
$('body').on('click', '.batch-delete-btn',function(){
	var arr = [];
	var href = $(this).attr('data-href');
	var name = $(this).attr('data-name') || 'id';
	var content = $(this).attr('data-content') || '您确定要删除选中的数据吗?';
	
	$(".checkbox-item:checked").each(function(){
		arr.push($(this).val());
	})
	
	if(arr.length<1){
		layer.msg("选项不能为空");return;
	}
	
	layer.open({
		content : content,
		icon : 3,
		btn : ['是','否'],
		yes : function(){
			location.href = href + '?' + name + '=' + arr;
		}
	})
})

/**
 * checkbox全选或全不选择
 */
$("#select-all").on("click",function(){
	$(".checkbox-item").prop("checked", $(this).prop("checked"));
})

/**
 * 点击更新排序
 */
$("#listorder-btn").on("click", function(){
	var data = $("#listorder-form").serializeArray();
	var postData = {};
	var url = $(this).attr('data-url');
	$(data).each(function(i){
		postData[this.name] = this.value || 0;
	})
	//console.log(url)

	var loadLayer = layer.load(0, {shade: false})
	$.ajax({
		url : url,type:"post",data:postData,dataType:"json",success:function(result){
			layer.close(loadLayer);
			if(result.status == 1){
				dialog.success(result.message, result.data.url);
			}
			if(result.status == 0){
				dialog.error(result.message);
			}
		}
	})
});

/**
 * 点击切换状态(默认切换发布状态)
 */
$('body').on('change', '.ace-switch',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	
	var name = $(this).attr('data-name') || 'is_publish';
	var checkedValue = $(this).attr('data-checkedValue') || 1;
	var uncheckedValue = $(this).attr('data-uncheckedValue') || 0;
	
	if(this.checked){
		$.ajax({
			url : url,type : 'get',data : {id: id, name: name,value: checkedValue},dataType : 'json',success: function(res){
				res.status == 1 ? layer.msg(res.message) : layer.msg(res.message);
			}
		})
	}else{
		$.ajax({
			url : url,type : 'get',data : {id: id, name: name, value: uncheckedValue},dataType : 'json',success: function(res){
				res.status == 1 ? layer.msg(res.message) : layer.msg(res.message);
			}
		})
	}
})

/**
 * tab切换
 */
$('body').on("click", '.tab-switch span' ,function(){
	var index = $(this).index();
	$(this).addClass("btn-success").siblings("span").removeClass("btn-success");
	$(".tab_table").hide();
	$(".tab_table").eq(index).show();
})

function toDelete(url, data, jumpUrl){
	$.ajax({
		url : url,
		type : 'get',
		data : data,
		dataType : 'json',
		success : function(result){
			if(result.status == 1){
				return dialog.success(result.message, jumpUrl);
			}else{
				return dialog.error(result.message);
			}
		}
	})
}

$('.layer-iframe').on('click', function(){
	var href = $(this).attr('data-href');
	var title = $(this).attr('data-title');
	var width = $(this).attr('data-width');
	var height = $(this).attr('data-height');
	layer.open({
	  type: 2,
	  title: title,
	  shadeClose: true,
	  shade: 0.8,
	  area: [width, height],
	  content: href,
	  btn: ['关闭'],
	  yes: function(index, layero){
		  layer.close(index);		  
	  }
	});
})


