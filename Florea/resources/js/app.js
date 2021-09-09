require('./bootstrap');

window.addEventListener("keydown", function (e) {
    if (["ArrowUp", "ArrowDown"].indexOf(e.code) > -1) {
        e.preventDefault();
    }
}, false);

let lastValue;

$("#SearchInput").on('focusout', e => {
    console.log(e);
    if(e.relatedTarget != null){
        e.stopPropagation();
    }else{
        $("#searchResults").hide();
        $("#searchInput").removeClass('focusedInput');
    }
})
$("#SearchInput").on('focusin', e => {
    $("#searchResults").show();
    $("#searchInput").addClass('focusedInput');
})

document.addEventListener('keyup', function(e){
    if(e.keyCode == 27){
        if($("#searchInput").hasClass('focusedInput')){
            $("#searchInput").hide();
        }
    }
})

$("#SearchInput").on('keyup', e => {
    let val;
    if (e.keyCode != 40 && e.keyCode != 38 && e.keyCode != 13) {
        $("#SearchInput").attr('data-value', e.target.value)
        val = $("[data-value]")[0].dataset.value;
        $("#search").attr('action', route('search.post'));
        if (val != '') {
            getData(e.target.action, val)
        }
    } else {
        if ($(".searchResults").length != 0) {
            if (e.keyCode == 38) {
                if ($(".searchResults.focused").length == 0) {
                    $(".searchResults").last('.searchResults').addClass('focused')
                    $("#search").attr('action', $(".searchResults.focused a")[0].href ?? route('search.post'));
                    $("#SearchInput").val($(".searchResults.focused a").text().trim())
                } else {
                    $(".searchResults.focused").removeClass('focused').prev('.list-group-item.searchResults').addClass('focused')
                    if($(".searchResults.focused a")[0] != undefined){
                        $("#search").attr('action', $(".searchResults.focused a")[0].href);
                        let vali = $("#SearchInput")[0].dataset.value
                        $("#SearchInput").val(vali);
                    }else{
                        $("#search").attr('action', 'search.php');
                        let vali = $("#SearchInput")[0].dataset.value
                        $("#SearchInput").val(vali)
                    }
                    $("#SearchInput").val($(".searchResults.focused a").text().trim())
                }
            } else if (e.keyCode == 40) {
                if ($(".searchResults.focused").length == 0) {
                    $(".searchResults").first('.searchResults').addClass('focused')
                    $("#search").attr('action', $(".searchResults.focused a")[0].href ?? 'search.php');
                    $("#SearchInput").val($(".searchResults.focused a").text().trim())
                } else {
                    $(".searchResults.focused").removeClass('focused').next('.list-group-item.searchResults').addClass('focused')
                    console.log($(".searchResults a")[0])
                    if($(".searchResults.focused a")[0] != undefined){
                        $("#search").attr('action', $(".searchResults.focused a")[0].href);
                        let vali = $("#SearchInput")[0].dataset.value
                        $("#SearchInput").val(vali);
                    }else{
                        $("#search").attr('action', 'search.php');
                        let vali = $("#SearchInput")[0].dataset.value
                        $("#SearchInput").val(vali);
                    }
                    $("#SearchInput").val($(".searchResults.focused a").text().trim())
                }
            }
        }
    }
})

let getData = (url = null, val) => {
    $.ajax({
        method: 'get',
        url: route('api.get_products', {q: val}),
        data: {},
        success: data => {
            $('#searchResults').html('');
            $("#searchResults").html(data);
            // $("#searchResults").html('');
            // $.each(data, (i, obj) => {
            //     let $el = axios
            //     $("#searchResults").append($el)
            // })
        },
        dataType: 'json'
    })
}

let a = ['é', 'è', 'ê', 'ë', 'à', 'ù', '\'', ' '];
let b = ['e', 'e', 'e', 'e', 'a', 'u', '-', '-']

let trim_special_chars = (input) => {
    a.forEach((p, key) => {
        input = input.replace(p, b[key]).toLowerCase();
    })
    return input
}

function str_slug(title, separator) {
    if (typeof separator == 'undefined') separator = '-';

    // Convert all dashes/underscores into separator
    var flip = separator == '-' ? '_' : '-';
    title = title.replace(flip, separator);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    title = title.toLowerCase()
            .replace(new RegExp('[^a-z0-9' + separator + '\\s]', 'g'), '');

    // Replace all separator characters and whitespace by a single separator
    title = title.replace(new RegExp('[' + separator + '\\s]+', 'g'), separator);

    return title.replace(new RegExp('^[' + separator + '\\s]+|[' + separator + '\\s]+$', 'g'),'');
}

function cart_add(product)
{
    console.log(product)
}