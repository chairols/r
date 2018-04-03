<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Listado de Vencimientos</h3>

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <div class="col-sm-offset-2 col-sm-8">
            <div class="space"></div>

            <div id="calendar"></div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function inicio() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();


        var calendar = $('#calendar').fullCalendar({
            //isRTL: true,
            //firstDay: 1,// >> change first day of week 

            buttonHtml: {
                prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                next: '<i class="ace-icon fa fa-chevron-right"></i>'
            },

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                <?=$events?>

            ]
            ,

            /**eventResize: function(event, delta, revertFunc) {
             
             alert(event.title + " end is now " + event.end.format());
             
             if (!confirm("is this okay?")) {
             revertFunc();
             }
             
             },*/

            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                var $extraEventClass = $(this).attr('data-class');


                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = false;
                if ($extraEventClass)
                    copiedEventObject['className'] = [$extraEventClass];

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            }
            ,
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {

                bootbox.prompt("New Event Title:", function (title) {
                    if (title !== null) {
                        calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay,
                                    className: 'label-info'
                                },
                                true // make the event "stick"
                                );
                    }
                });


                calendar.fullCalendar('unselect');
            }
            ,
            eventClick: function (calEvent, jsEvent, view) {

                //display a modal
                var modal =
                        '<div class="modal fade">\
                          <div class="modal-dialog">\
                           <div class="modal-content">\
                                 <div class="modal-body">\
                                   <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                                   <form class="no-margin">\
                                          <label>Change event name &nbsp;</label>\
                                          <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
                                         <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
                                   </form>\
                                 <br>\
                                 <strong>Operacion: </strong>'+calEvent.operacion+'<br>\
                                 <strong>Concepto: </strong>'+calEvent.concepto+'<br>\
                                 <strong>Impuesto: </strong>'+calEvent.impuesto+'<br>\
                                 <strong>Formularios: </strong>'+calEvent.formularios+'<br>\
                                 </div>\
                                 <div class="modal-footer">\
                                        <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Eliminar Evento</button>\
                                        <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancelar</button>\
                                 </div>\
                          </div>\
                         </div>\
                        </div>';


                var modal = $(modal).appendTo('body');
                modal.find('form').on('submit', function (ev) {
                    ev.preventDefault();

                    calEvent.title = $(this).find("input[type=text]").val();
                    calendar.fullCalendar('updateEvent', calEvent);
                    modal.modal("hide");
                });
                modal.find('button[data-action=delete]').on('click', function () {
                    calendar.fullCalendar('removeEvents', function (ev) {
                        return (ev._id == calEvent._id);
                    })
                    modal.modal("hide");
                });

                modal.modal('show').on('hidden', function () {
                    modal.remove();
                });


                //console.log(calEvent.id);
                //console.log(jsEvent);
                //console.log(view);

                // change the border color just for fun
                //$(this).css('border-color', 'red');

            }

        });
    }
</script>