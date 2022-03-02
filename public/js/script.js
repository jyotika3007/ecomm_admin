function getChildCategories(id){
		$.ajax({
			headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
			type: "POST",
			data: { 'id': id },
			url: '/get-sub-categories',
			success:function(data){
					console.log(data)
					sub_categories = data.sub_categories;
					result = '<ul>';
				if(sub_categories.length>0){

					for(i=0; i<sub_categories.length; i++){

					result+=`<li style="position : relative"><input type="checkbox" value="${sub_categories[i].id}" name="parent_id"  /> &nbsp ${sub_categories[i].category_name} <span style="position: absolute; right: 0; cursor: pointer"> <i class="fa fa-angle-down" onclick="getChildCategories(${sub_categories[i].id})"></i> </span>
					<div id="subList${sub_categories[i].id}"></div>
					</li>`;

					}
				}
					result+="</ul>";

					console.log(result);

					$('#subList'+id).html(result);

			}
		})
	}
