/**
 * Theme: Minton Admin Template
 * Author: Coderthemes
 * Component: Full-Calendar
 *
 */

var $event;
var $compromisso = [];
var $fullCalendar = $('#calendar');
var $addCategory = $('#add-category');
var $envetForm;
var $agendaForm;
var $moda;
$(document).ready(function () {
    $fullCalendar.fullCalendar({
        slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
        minTime: '08:00:00',
        maxTime: '19:00:00',
        locale: 'pt-br',
        defaultView: 'month',
        handleWindowResize: true,
        height: $(window).height() - 200,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: {
            url: $fullCalendar.attr('data-url').replace('action', 'list-event'),
            error: function () {
                toastr.error("Error");
            }
        },
        loading: function(bool) {
            $('#loading').remove();
        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper:true,
        defaultView:'agendaDay',
        drop: function (date) {
            onDrop($(this), date);
        },
        select: function (start, end, allDay) {
            onSelect(start, end);
        },
        eventClick: function (event) {
            onEventClick(event);
        }
    });

    $addCategory.click(function () {
        $.ajax({
            url: $addCategory.attr('data-url'),
            type: 'get',
            dataType: 'html',
            success: function (data) {
                $moda = $(data).modal({
                    backdrop: 'static'
                }).on('shown.bs.modal', function (e) {
                    $envetForm = $('form[name="AjaxEventForm"]');
                    eventForm($envetForm);
                }).on('hidden.bs.modal', function (e) {
                    $moda.remove();
                    listEvent();
                })

            }
        })
    })
    listEvent();
});

var agendaForm = function ($form) {
    $form.ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {
            var queryString = $.param(formData);

            // jqForm is a jQuery object encapsulating the form element.  To access the
            // DOM element for the form do this:
            $compromisso = {
                id: jqForm.find("input[name='id']").val(),
                title: jqForm.find("input[name='title']").val(),
                start: jqForm.find("input[name='start']").val(),
                end: jqForm.find("input[name='end']").val(),
                eventId: jqForm.find("input[name='event_id']").val(),
                description: jqForm.find("input[name='description']").val()
            }
            return true;
        }, // pre-submit callback
        success: function (responseText, statusText, xhr, $form) {
            $($form).find('.modal-dialog').html(responseText);
        }, // post-submit callback
        type: 'post', // 'get' or 'post', override for form's 'method' attribute
        dataType: 'html' // 'xml', 'script', or 'json' (expected server response type)
    });
}

var eventForm = function ($form) {
    $form.ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {
            return true;
        }, // pre-submit callback
        success: function (responseText, statusText, xhr, $form) {
            listEvent();
            $($form).find('.modal-dialog').html(responseText);
        }, // post-submit callback
        type: 'post', // 'get' or 'post', override for form's 'method' attribute
        dataType: 'html' // 'xml', 'script', or 'json' (expected server response type)
    });
}


var listEvent = function () {
    $.ajax({
        url: $addCategory.attr('data-url').replace('add', 'listar'),
        type: 'get',
        dataType: 'html',
        success: function (data) {
            $("#external-events").html(data);
        },
        complete: function () {
            enableDrag($(".external-event"));
        }
    })
}

var onDrop = function (eventObj, date) {
    // retrieve the dropped element's stored Event Object
    var originalEventObject = eventObj.data('eventObject');
    var $categoryClass = eventObj.attr('data-class');
    // we need to copy it, so that multiple events don't have a reference to the same object
    var copiedEventObject = $.extend({}, originalEventObject);
    // assign it the date that was reported
    copiedEventObject.start = date;
    if ($categoryClass)
        copiedEventObject['className'] = [$categoryClass];
    // render the event on the calendar
    $fullCalendar.fullCalendar('renderEvent', copiedEventObject, true);
    // is the "remove after drop" checkbox checked?
    if ($('#drop-remove').is(':checked')) {
        // if so, remove the element from the "Draggable Events" list
        eventObj.remove();
    }
}

var onEventClick = function (event) {
    $data = {
        id: event.id,
        title: event.title,
        description: event.description,
        eventId: event.eventId,
        start: moment(event.start).format('DD/MM/YYYY HH:mm'),
        end: moment(event.end).format('DD/MM/YYYY HH:mm')
    };
    $.ajax({
        url: $fullCalendar.attr('data-url').replace('action', 'update').replace('id', event.id),
        type: 'post',
        dataType: 'html',
        data: $data,
        success: function (data) {
            $moda = $(data).modal({
                backdrop: 'static'
            }).on('shown.bs.modal', function (e) {
                $agendaForm = $('form[name="AjaxAgendaForm"]');
                agendaForm($agendaForm);
            }).on('hidden.bs.modal', function (e) {
                $moda.remove();
            })

        }
    })
}

var enableDrag = function ($events) {
    //init events
    $($events).each(function () {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            eventId: $.trim($(this).attr('data-id')),
            title: $.trim($(this).text()),
            description: $.trim($(this).attr('data-description')),
            className: $.trim($(this).attr('data-class')),
        };
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);
        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });
    });
}
var onSelect = function (start, end) {
    var $data = {
        'start': moment(start).format('DD/MM/YYYY HH:mm'), 'end': moment(end).format('DD/MM/YYYY HH:mm')
    }
    $.ajax({
        url: $fullCalendar.attr('data-url').replace('action', 'add'),
        type: 'post',
        data: $data,
        dataType: 'html',
        success: function (data) {
            $moda = $(data).modal({
                backdrop: 'static'
            }).on('shown.bs.modal', function (e) {
                $agendaForm = $('form[name="AjaxAgendaForm"]');
                agendaForm($agendaForm);
            }).on('hidden.bs.modal', function (e) {
                $moda.remove();
            })

        }
    })
    $fullCalendar.fullCalendar('unselect');
}


