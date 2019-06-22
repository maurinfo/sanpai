 $("#submitsearch").click(function(event) {
        event.preventDefault();
        $("form").submit();


    });

    $("button").click(function(event) {
        var btnName = this.name
        if (btnName.includes("print")) {
            var refid = this.id;

            addToPrintq(refid);
            $(this).attr('class', 'btn-pure btn-danger icon md-print');

        }

    });


    function addToPrintq(refid) {

        $.ajax({
            url: baseURL+ 'printq/add',
            method: "POST",
            dataType: 'html',
            data: {
                typeid: 2,
                refid: refid,

            },
            success: function(data) {

                getPrintListCount();

            }

        });

    };

    function getPrintListCount() {

        $.ajax({
            url: baseURL+ 'printq/getCount',
            method: "GET",
            dataType: 'text',
            data: {

            },
            success: function(data) {

                showPrintListCount(data);

            }

        });
    }

    function showPrintListCount(data) {

        $("#printcounter").html(data);
    }
