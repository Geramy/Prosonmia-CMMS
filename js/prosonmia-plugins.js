var Prosonmia = {
	Gridster: function() {

	},
	Report: {

	}
};
var savingBool = false;
Prosonmia.Report.SaveColumn = function($columnName, $dbID, callb) {
	$.ajax({
      method: "POST",
      url: "/includes/itasm.networking.php",
      data: { RQ: "ReportC", Method: "SetColumn", id: $dbID, id1: $columnName }
  })
  .done(function( msg ) {

    if(callb != undefined)
			callb();
  });
};
$.fn.setCursorPosition = function() {
  pos = $(this).val().length;
  this.each(function(index, elem) {
    if (elem.setSelectionRange) {
      elem.setSelectionRange(pos, pos);
    } else if (elem.createTextRange) {
      var range = elem.createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  });
  return this;
};
$.fn.JQluvAutoSaveInit = function() {
     $(this).find(".proson-nochange").each(function() {
        $(this).data("sval", $(this).val());
    });
};
$.fn.JQluvSaveInit = function() {

    $(this).on("change keyup paste", function() {
        //Put Saving text Below element in red


        if($(this).data("sval") == $(this).val())
            return;
        $(this).data("sval", $(this).val());
        if(savingBool === false)
        {
        	savingBool = true;
        	$(this).after("<div class='saving_alert'>Saving...</div>");
        }
        if($(this).hasClass("proson-nochange"))
            $(this).removeClass("proson-nochange");
        if(!$(this).hasClass("proson-change"))
            $(this).addClass("proson-change");
    });
};
$.fn.JQluvAutoSave = function() {
    $(this).find(".proson-change").each(function() {
        $(this).JQluvDBSubmit();
    });
};
$.fn.JQluvAutoCompleteDialog = function(Title, Message) {
    bootbox.dialog({
      message: Message,
      title: Title,
      buttons: {
        success: {
          label: "Select!",
          className: "btn-success",
          callback: function() {
            Example.show("great success");
          }
        },
        cancel: {
          label: "Cancel!",
          className: "btn-cancel",
          callback: function() {
            Example.show("uh oh, look out!");
          }
        }
      }
    });
};
$.fn.NewRecord = function(comp_mod, hasDate) {
	var action = "HTMLC";
	var module = "RG";
	var $this = this;
	$.ajax({
      method: "POST",
      url: "/includes/itasm.networking.php",
      data: { RQ: action, Method: module, "id": comp_mod }
    })
    .done(function( msg ) {
        $($this).append(msg);
        if(hasDate)
        	$('.date').datepicker({});
    });
};
$.fn.NewJobListItem = function(tbod) {
    var rows = $('tbody').find("tr").length;
    $(tbod).append(
        "<tr> \
            <td><input type=\"text\" class=\"input-group input-group-lg proson-white-text\" name=\"jobli_"+rows+"_name\" /></td>\
            <td><input type=\"checkbox\" class=\"input-group input-group-lg\" name=\"jobli_"+rows+"_pass_required\" /></td>\
            <td><input type=\"checkbox\" class=\"input-group input-group-lg\" name=\"jobli_"+rows+"_notes\" /></td>\
            <td><input type=\"checkbox\" class=\"input-group input-group-lg\" name=\"jobli_"+rows+"_require_notes\" /></td>\
            <td><div class=\"proson-delete-item\"><span class=\"glyphicon glyphicon-minus\"></span></div></td>\
        </tr>");
    $("#total_rows").val($('tbody').find("tr").length);
};
$.fn.JQluvGetBody = function(action, module, rp_id, rp_id1, finished) {
	$that = this;
  $.ajax({
      method: "POST",
      url: "/includes/itasm.networking.php",
      data: { RQ: action, Method: module, id: rp_id, id1: rp_id1 }
  })
  .done(function( msg ) {
    $elem = $(msg);
		$($that).append($elem);
		if(finished != undefined)
			finished($elem);
  });
};
$.fn.JQluvDBSubmit = function() {
    $.ajax({
      method: "POST",
      url: "/includes/itasm.networking.php",
      data: { RQ: ProsonmiaCore.mod, Method: "EditItem", id: ProsonmiaCore.id, key: $(this).attr("name"), value: $(this).val() }
    })
    .done(function( msg ) {
        //change to Saved. in green after a second fadeout

        $('.saving_alert').replaceWith("<div class='saved_alert'>Saved.</div>");
        setTimeout(function() {
        		$('.saved_alert').fadeOut("slow", function() {
              if(savingBool = true){savingBool = false;}
            });
    	}, 1000);
    });
    if($(this).hasClass("proson-change"))
       $(this).removeClass("proson-change");
   if(!$(this).hasClass("proson-nochange"))
        $(this).addClass("proson-nochange");

};
$.fn.JQluvToolbox = function(RightElements, item_dropped) {
	var itemO = null;
	var OverItem = false;
	var selected = null;
	var OriginalPos = {};
	var DropArea = {};
	var droppable = $(RightElements).find(".row > .drop-column-highlight");
	var dOffsets = [];
	var dSize = [];
	if(droppable.size() <= 1)
		droppable = [$(RightElements)];
	for(i = 0; i < droppable.length; i++) {
		dOffsets.push($(droppable[i]).offset());
		dSize.push({"width": $(droppable[i]).width(), "height": $(droppable[i]).height() });
	}
	$(this).on("mousedown", function() {

		_drag_init(this);
	    return false;
	});
	_drag_init = function(item) {
		selected = item;
		offset = $(selected).offset();
		OriginalPos["x"] = offset.left;
		OriginalPos["y"] = offset.top;
    	x_elem = offset.left;
    	y_elem = offset.top;
	};
	_move_elem = function(e) {

	    x_pos = document.all ? window.event.clientX : e.pageX;
	    y_pos = document.all ? window.event.clientY : e.pageY;
	    if (selected !== null) {
	        selected.style.left = (x_pos - x_elem) + 'px';
	        selected.style.top = (y_pos - y_elem) + 'px';
	        matches = false;
	        OverItem = false;
	        for(i = 0; i < dOffsets.length; i++) {
	        	if(droppable[i] == null)
	        		continue;
	        	if(x_pos > dOffsets[i].left && y_pos > dOffsets[i].top && y_pos < dSize[i].height + dOffsets[i].top && x_pos < dSize[i].width + dOffsets[i].left) {
	        		$(droppable[i]).removeClass("drop-column-highlight");
	        		$(droppable[i]).addClass("drop-column");
	        		matches = true;
	        		OverItem = true;
	        		itemO = i;
	        	}
	        }
	        if(!matches) {
	        	$(RightElements).find(".row > .drop-column").removeClass("drop-column").addClass("drop-column-highlight");
	        }
	    }
	};
	_destroy = function() {
		if(!OverItem && selected != null)
		{
			selected.style.left = (OriginalPos["x"] - x_elem) + 'px';
      selected.style.top = (OriginalPos["y"] - y_elem) + 'px';
		}
		else {
			$(droppable[itemO]).removeClass("drop-column");
    		$(droppable[itemO]).addClass("drop-column-done");
			$(droppable[itemO]).find("p").html($(selected).find("p").html());
			item_dropped($(selected).find("p"), $(droppable[itemO]).find("p"));
			$(selected).remove();
			droppable[itemO] = null;
		}
		OriginalPos = {};
		selected = null;
	};
	document.onmousemove = _move_elem;
	document.onmouseup = _destroy;
};
(function($){
    var proxy = $.fn.serializeArray;
    $.fn.serializeArray = function(){
        var inputs = this.find(':disabled');
        inputs.prop('disabled', false);
        var serialized = proxy.apply( this, arguments );
        inputs.prop('disabled', true);
        return serialized;
    };
})(jQuery);
