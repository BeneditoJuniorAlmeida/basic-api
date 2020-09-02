// LOCAL
var URL = "http://localhost/gamepi/"; // @lacy 
// var URL = "http://localhost/labex/bit-edu/"; // @gnleo

// ONLINE
//const URL = 'https://bitedu.com.br/';

var tableData = itens;
var resultado = null;
var color_button;

var linha = parseInt(document.getElementById("item").value);
alert(linha);
var identificador_table = $('#our-table').attr('data-url');

var state = {
    'querySet': tableData,
    'page': 1,
    'rows': linha,
    'window': 5,
}


document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('select[id="item"]').onchange = itemPaginacao;
}, false);

function itemPaginacao(event) {
    linha = parseInt(document.getElementById("item").value);
    location.reload();
}

/*
1 - Loop Through Array & Access each value
2 - Create Table Rows & append to table
*/

buildTable()

function pagination(querySet, page, rows) {

    var trimStart = (page - 1) * rows
    var trimEnd = trimStart + rows

    var trimmedData = querySet.slice(trimStart, trimEnd)

    var pages = Math.ceil(querySet.length / rows);

    return {
        'querySet': trimmedData,
        'pages': pages,
    }
}

function pageButtons(pages) {
    var wrapper = document.getElementById('pagination');

    wrapper.innerHTML = ``;
    // console.log('Pages:', pages);

    var maxLeft = (state.page - Math.floor(state.window / 2));
    var maxRight = (state.page + Math.floor(state.window / 2));

    if (maxLeft < 1) {
        maxLeft = 1;
        maxRight = state.window;
    }

    if (maxRight > pages) {
        maxLeft = pages - (state.window - 1);

        if (maxLeft < 1) {
            maxLeft = 1;
        }
        maxRight = pages;
    }

    for (var page = maxLeft; page <= maxRight; page++) {
        wrapper.innerHTML += `<span><button id="${'fixo' + page}" data-fixo="${page}" value=${page} class="page btn btn-sm fixo btn-success">${page}</button></span>`;
    }

    if (state.page != 1) {
        wrapper.innerHTML = `<button value=${1} class="page btn btn-sm btn-success">&#171; Iníco</button>` + wrapper.innerHTML;
    }

    if (state.page != pages) {
        wrapper.innerHTML += `<button value=${pages} class="page btn btn-sm btn-success">Última página &#187;</button>`;
    }

    $('.page').on('click', function() {
        $('#table-body').empty();
        state.page = Number($(this).val());
        buildTable();
    })
}


function buildTable() {
    var table = $('#table-body');

    var data = pagination(state.querySet, state.page, state.rows);
    var listaItens = data.querySet;
    var row;


    for (var i = 1 in listaItens) {
        row = `<tr>
                            <td>
                                <label class="container">
                                    <input type="checkbox" value="${listaItens[i].id_pergunta}" id="id_pergunta" name="id_pergunta" />
                                    <span class="checkmark"></span>
                                </label>    
                            </td>
                            <td data-id='${listaItens[i].id_pergunta}'>${listaItens[i].pergunta}</td>
                         
                        </tr>`;
        table.append(row);
    }

    pageButtons(data.pages);
}