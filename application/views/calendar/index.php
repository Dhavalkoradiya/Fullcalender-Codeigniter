<!DOCTYPE html>
<html>
<head>
	<title>Full Calendar + Codeigniter</title>

	<?php echo link_tag('vendor/bootstrap/css/bootstrap.min.css'); ?>
	<?php echo link_tag('vendor/fullcalendar/css/fullcalendar.css'); ?>
	<?php echo link_tag('vendor/datetimepicker/jquery.datetimepicker.css'); ?>

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card mb-3">
					<h3 class="card-header bg-dark text-white">Calendar</h3>
					<div class="card-body">
						<?php if($this->session->flashdata('success')): ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<?php echo strip_tags($this->session->flashdata('success'));?>
							</div>
						<?php endif; ?>

						<div id="calendar"></div>
					</div>
					<div class="card-footer bg-dark text-white text-center">
						<p>Dhaval Koradiya - businesswithdhaval@gmail.com</p>
						<p>Connect with me @ <a href="https://www.linkedin.com/in/dhavalkoradiya/" class="text-info" target="_blank">https://www.linkedin.com/in/dhavalkoradiya/</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- create event -->
	<div class="modal fade effect" id="addModal">
		<div class="modal-dialog modal-lg modal-dialog-vertical-center event-popup" role="document">
			<div class="modal-content bd-0 tx-14">
				<div class="modal-header">
					<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Calendar Event</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pd-25">
					<?php echo form_open(site_url("calendar/add_event"), array("class" => "form-horizontal")) ?>
					<div class="form-layout">
						<div class="row mg-b-25">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label">Start Date <span class="tx-danger">*</span></label>
									<input type="text" autocomplete="off" class="form-control datepicker" name="start_date" id="new_start_date" required="required">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label">End Date <span class="tx-danger">*</span></label>
									<input type="text" autocomplete="off" class="form-control datepicker" name="end_date" id="new_end_date" required="required">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Event Name <span class="tx-danger">*</span></label>
									<input type="text" class="form-control" name="name" autocomplete="off" required="required">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Description</label>
									<textarea class="form-control" name="description"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Add Event">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>

	<!-- edit event -->
	<div class="modal fade" id="editModal" role="document">
		<div class="modal-dialog modal-lg modal-dialog-vertical-center event-popup" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Calendar Event</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo form_open(site_url("calendar/edit_event"), array("class" => "form-horizontal")) ?>
					<div class="form-layout">
						<div class="row mg-b-25">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label">Start Date</label>
									<input type="text" class="form-control datepicker" name="start_date" id="start_date">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label">End Date</label>
									<input type="text" class="form-control datepicker" name="end_date" id="end_date">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Event Name</label>
									<input type="text" class="form-control" name="name" autocomplete="off" value="" id="name">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Description</label>
									<textarea class="form-control" name="description" id="description"></textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="ckbox ckbox-danger">
										<input type="checkbox" name="delete" value="1"><span>Delete Event</span>
									</label>
								</div>
							</div>
							<input type="hidden" name="eventid" id="event_id" value="0" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Update Event">
				</div>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('vendor/jquery/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('vendor/datetimepicker/jquery.datetimepicker.full.min.js'); ?>"></script>
	<script src="<?php echo base_url('vendor/jquery/jQuery.bootstrap-flash-alert.js'); ?>"></script>
	<script src="<?php echo base_url('vendor/moment/js/moment.js'); ?>"></script>
	<script src="<?php echo base_url('vendor/fullcalendar/js/fullcalendar.js'); ?>"></script>

	<script type="text/javascript">
		var date_last_clicked = null;

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: new Date(),
			defaultView: 'month',
			selectable: true,
			selectHelper: true,
			default: false,
			editable: true,
			eventLimit: true,
			displayEventEnd: true,
			forceEventDuration: true,
			nowIndicator: true,
			defaultTimedEventDuration: '00:30:00',
			cache: true,
			eventSources: [
			{
				events: function(start, end, timezone, callback) {
					$.ajax({
						url: '<?php echo base_url('calendar/get_events') ?>',
						dataType: 'json',
						data: {                
							start: start.unix(),
							end: end.unix()
						},
						success: function(msg) {
							var events = msg.events;
							callback(events);
						}
					});
				}
			},
			],
			eventRender: function (event, element, view) {
				if (event.description != '' ) {
					element.find('.fc-title').append('<div class="bd bd-1"></div><small class="tx-9">'+event.description+'</small></div>');
				}
			},
			select: function (start, end, jsEvent, view) {
				$('#new_start_date').val(moment(start).format('YYYY-MM-DD HH:mm'));
				$('#new_end_date').val(moment(end).format('YYYY-MM-DD HH:mm'));
				$('#addModal').modal();
				$('#calendar').fullCalendar('refetchEvents');
			},
			eventClick: function(event, jsEvent, view) {
				$('#name').val(event.title);
				$('#description').val(event.description);
				$('#start_date').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
				if(event.end) {
					$('#end_date').val(moment(event.end).format('YYYY-MM-DD HH:mm'));
				} else {
					$('#end_date').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
				}
				$('#event_id').val(event.id);
				$('#editModal').modal();
			},
			eventResize: function (event, delta) {
				var start = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
				var end = moment(event.end).format('YYYY-MM-DD HH:mm:ss');
				var current_date = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');
				if ((start > current_date) || (start == current_date) || true) {
					$.ajax({
						url: '<?php echo base_url('calendar/update_calendar') ?>',
						data: 'title=' + event.title + '&start_date=' + start + '&end_date=' + end + '&eventid=' + event.id,
						type: "POST",
						success: function (json) {
							$.alert("Updated Successfully", {
								title: false,
								autoClose: true,
								type: 'success',
								closeTime: 2000,
								position: ['bottom-left', [10, 50]],
								animation: false,
								animShow: 'fadeIn',
								animHide: 'fadeOut'
							}
							);
						}
					});
				} else {
					alert('Start date should be greater than current date');
					location.reload();
				}
			},
			eventDrop: function (event, delta) {
				var start = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
				var end = moment(event.end).format('YYYY-MM-DD HH:mm:ss');
				var current_date = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');
				if ((start > current_date) || (start == current_date) || true) {
					$.ajax({
						url: '<?php echo base_url('calendar/update_calendar') ?>',
						data: 'title=' + event.title + '&start_date=' + start + '&end_date=' + end + '&eventid=' + event.id,
						type: "POST",
						success: function (json) {
							$.alert("Updated Successfully", {
								title: false,
								autoClose: true,
								type: 'success',
								closeTime: 2000,
								position: ['bottom-left', [10, 50]],
								animation: false,
								animShow: 'fadeIn',
								animHide: 'fadeOut'
							}
							);
						}
					});
				} else {
					alert('Start date should be greater than current date');
					location.reload();
				}
			},
		});

    // Datepicker
    $('.datepicker').datetimepicker({
    	format: "Y-m-d H:i",
    	step:30
    });
</script>

</body>
</html>
