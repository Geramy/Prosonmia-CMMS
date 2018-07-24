Prosonmia.Gridster.elmn_num = 0;
Prosonmia.Gridster.Grids = {};
		
Prosonmia.Gridster.SetupGrid = function() 
{
	$(".rpt-btn").on("click", function(evt) {
		Prosonmia.Gridster.AddMainComponent($(this));
	});
	$(".rpt-active-btn").on("click", function(evt) {
		Prosonmia.Gridster.AddSubComponent($(this));
	});
};
Prosonmia.Gridster.CreateGrid = function(element, id) 
{
	switch(id) {
		case 0://header component
			ourId = $(element).attr("id");
			$(element).addClass(ourId.replace("#", ""));
			nGrdElm = $("." + ourId.replace("#", "") + " > div > ul").gridster({
                widget_margins: [10, 1],
                widget_base_dimensions: [130, 80],
                autogenerate_stylesheet: false
            }).data().gridster;
            $("." + ourId.replace("#", "") + " > div > ul").removeAttr("position");
			Prosonmia.Gridster.Grids[$(element).attr("id")] = nGrdElm;
			break;
		case 1://footer component
			
			break;
		case 2: //content component
			
			break;
	}
};

Prosonmia.Gridster.AddMainComponent = function(element) {
	rpt_types = $("#trptt > #rpt-types");
	elmn = $(element).attr("name");
	code = document.getElementById(elmn).outerHTML;
	element = gridster.add_widget(code, 5, 1, 1, 1);
	$(element).attr("id", elmn + Prosonmia.Gridster.elmn_num++);
	$(element).ready(function() {
		new Prosonmia.Gridster.GridItem(element);
	});
	
};
Prosonmia.Gridster.AddSubComponent = function(element) {
	CurrentItem = $(".pros-gFocus").attr("id");
	rpt_types = $("#trptt > #rpt-types");
	elmn = $(element).attr("name");
	code = document.getElementById(elmn).outerHTML;
	element = Prosonmia.Gridster.Grids[CurrentItem].add_widget(code, 1, 1);
	$(element).attr("id", elmn + Prosonmia.Gridster.elmn_num++);
	new Prosonmia.Gridster.GridItem(element);
};
Prosonmia.Gridster.NewComponent = function() {
	
};
Prosonmia.Gridster.GridItem = function(htmlComponent) {
	if($(htmlComponent).hasClass("rpt-header"))
		SetupMiniGrid(0);
	else if($(htmlComponent).hasClass("rpt-footer"))
		SetupMiniGrid(1);
	else if($(htmlComponent).hasClass("rpt-content"))
		SetupMiniGrid(2);
	
	function SetupMiniGrid(id) {
		
		$(htmlComponent).on("click", function(evt) {
			$("div .gridster > ul > li").removeClass("pros-gFocus");
			$(this).addClass("pros-gFocus");
		});
		Prosonmia.Gridster.CreateGrid($(htmlComponent), id);
	}
	function AddGrid() {
		
	}
};