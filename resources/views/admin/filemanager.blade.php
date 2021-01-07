<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-sm-7">
            <a href="javascript:void(0)" data-href="<?php echo $datas['parent']; ?>" data-toggle="tooltip" title="" id="button-parent" class="btn btn-default"><i class="fas fa-level-up-alt"></i></a>
            <a href="javascript:void(0)" data-href="<?php echo $datas['refresh']; ?>" data-toggle="tooltip" title="" id="button-refresh" class="btn btn-default"><i class="fas fa-sync-alt"></i></a>
          <button type="button" data-toggle="tooltip" title="" id="button-upload" class="btn btn-primary"><i class="fas fa-upload"></i></button>
          <button type="button" data-toggle="tooltip" title="" id="button-folder" class="btn btn-default"><i class="fas fa-folder"></i></button>
          <button type="button" data-toggle="tooltip" title="" id="button-delete" class="btn btn-danger"><i class="fas fa-trash"></i></button>
          <button type="button" data-toggle="tooltip" title="" id="button-select" class="btn btn-primary">Select</button>

        </div>

      </div>
      <hr />

      <div class="row">
        <?php foreach ($images as $image) { ?>
        <div class="col-sm-2 text-center">
          <?php if ($image['type'] == 'directory') { ?>
          <div class="text-center"><a href="<?php echo $image['href']; ?>" class="directory" style="vertical-align: middle;"><i class="fa fa-folder fa-5x"></i></a></div>
          <label>
            <input type="checkbox" name="path[]" value="<?php echo $image['path']; ?>" />
            <?php echo $image['name']; ?></label>
          <?php } ?>
          <?php if ($image['type'] == 'image') { ?>
          <a href="<?php echo $image['href']; ?>" class="thumbnail"><img src="{{ asset($image['thumb']) }}" alt="{{ asset($image['thumb']) }}" title="<?php echo $image['name']; ?>" /></a>
          <label>
            <input type="checkbox" name="path[]" value="<?php echo $image['path']; ?>" />
            <?php echo $image['name']; ?></label>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <br />

    </div>
    <div class="modal-footer">{{ $images->render() }}</div>
  </div>
</div>

<script type="text/javascript"><!--
$(document).ready
<?php if ($datas['target']) { ?>
$('a.thumbnail').on('click', function(e) {
	e.preventDefault();

	<?php if ($datas['thumb']) { ?>
	$('#<?php echo $datas['thumb'] ; ?>').find('img').attr('src', $(this).find('img').attr('src'));
	<?php } ?>

	$('#<?php echo $datas['target']; ?>').attr('value', $(this).parent().find('input').attr('value'));

	$('#modal-image').modal('hide');
});

<?php } else { ?>
// Get the current selection
var range = window.getSelection();
var node = range.startContainer;
var startOffset = range.startOffset;  // where the range starts
var endOffset = range.endOffset;      // where the range ends

$('a.thumbnail').on('click', function(e) {
	e.preventDefault();

    // Create a new range from the orginal selection
    var range = document.createRange();
    range.setStart(node, startOffset);
    range.setEnd(node, endOffset);

    var img = document.createElement('img');
	img.src = $(this).attr('href');

	range.insertNode(img);

	$('#modal-image').modal('hide');
});
<?php } ?>

$('a.directory').on('click', function(e) {
	e.preventDefault();

	$('#modal-image').load($(this).attr('href'));
});

$('.pagination a').on('click', function(e) {
	e.preventDefault();

	$('#modal-image').load($(this).attr('href'));
});

$('#button-parent').on('click', function(e) {
	e.preventDefault();

	$('#modal-image').load($(this).attr('data-href'));
});

$('#button-refresh').on('click', function(e) {
	e.preventDefault();
    $('#modal-image').load($(this).attr('data-href'));
});

$


//--></script>
<script type="text/javascript"><!--
$('#button-upload').on('click', function() {
	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" id="file" name="file[]" multiple value="" /><input type="text" name="_token" value="{{ csrf_token() }}" /></form>');

	$('#form-upload #file').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload #file').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: '{{ url('/admin/filemanager/upload/') }}?directory=<?php echo $datas['directory']; ?>',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$('#button-upload i').replaceWith('<i class="fas fa-spinner fa-spin"></i>');
					$('#button-upload').prop('disabled', true);
				},
				complete: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
					$('#button-upload').prop('disabled', false);
				},
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}

					if (json['success']) {
						alert(json['success']);

						$('#button-refresh').trigger('click');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

$('#button-folder').popover({
	html: true,
	placement: 'bottom',
	trigger: 'click',
	title: 'Folder Name',
    sanitize: false,
	content: function() {
		html  = '<div class="input-group">';
		html += '<input type="text" name="folder" value="" placeholder="Folder Name" class="form-control"><input type="hidden" name="_token" value="{{ csrf_token() }}" >';
		html += '<span class="input-group-btn"><button type="button" title="" id="button-create" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></span>';
		html += '</div>';

		return html;
	}
});

$('#button-folder').on('shown.bs.popover', function() {
	$('#button-create').on('click', function() {
		var folder=$('input[name=\'folder\']').val();
		var token = $('input[name=\'_token\']').val();
		$.ajax({
			url: '{{ url('/admin/filemanager/folder/') }}?directory=<?php echo $datas['directory']; ?>',
			type: 'post',
			dataType: 'json',
			data: 'folder=' + folder + '&_token='+ token,
			beforeSend: function() {
				$('#button-create').prop('disabled', true);
			},
			complete: function() {
				$('#button-create').prop('disabled', false);
			},
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				}

				if (json['success']) {
					alert(json['success']);

					$('#button-refresh').trigger('click');
				}
                $('.popover').remove();
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
});

$('#modal-image #button-delete').on('click', function(e) {
	if (confirm('Do you Want to delete This?')) {

		var users = $('input[name="path[]"]:checked').map(function(){
                    return this.value;
                }).get();
		var token = '{{ csrf_token() }}';
		if (users != '') {
		$.ajax({
			url: '{{ url('/admin/filemanager/delete/?') }}',
			type: 'get',
			dataType: 'json',
			data: 'path='+ users,
			beforeSend: function() {
				$('#button-delete').prop('disabled', true);
			},
			complete: function() {
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				}

				if (json['success']) {
					alert(json['success']);

					$('#button-refresh').trigger('click');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	} else{
		alert('You did not select Any data!');
	}
	}
});

$('#modal-image #button-select').on('click', function(e) {


		var users = $('input[name="path[]"]:checked').map(function(){
                    return this.value;
                }).get();
		var token = '{{ csrf_token() }}';
		if (users != '') {
		$.ajax({
			url: '{{ url('/admin/filemanager/select_multiple/?') }}',
			type: 'get',
			dataType: 'json',
			data: 'path='+ users,
			beforeSend: function() {
				$('#button-select').prop('disabled', true);
			},
			complete: function() {
				$('#button-select').prop('disabled', false);
			},
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				}
				if(json['files'])
				{
					var html = '';
					var image_ro = 1000;
					for(var i =0;i < json['files'].length;i++)
						{

						  var item = json['files'][i];
						  html  += '<tr id="image-row' + image_ro + '">';
						  html += '  <td class="text-left"><a href="" id="thumb-image' + image_ro + '"data-toggle="image" class="img-thumbnail"><img src="' + item.f_path + '" alt="" title="" data-placeholder="' + item.placeholder + '" /><input type="hidden" name="product_image[' + image_ro + '][image]" value="' + item.fname + '" id="input-image' + image_ro + '" /></td>';
						  html += '  <td class="text-right"><textarea name="product_image[' + image_ro + '][image_description]" class="form-control"></textarea></td>';
						  html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_ro  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
						  html += '</tr>';


						  image_ro++;

						}

						$('#images tbody').append(html);
						$('#modal-image .close').trigger('click');
				}

			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	} else{
		alert('You did not select Any data!');
	}

});

//--></script>
