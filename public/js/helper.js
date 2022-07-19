$(document).ready( function () {

    setUnsetLoading();

});

function loadModal(button) {
    let url = button.getAttribute('data-url');
    let divModal = document.getElementById('modal');

    setUnsetLoading();

    axios.get(url)
        .then(({data}) => {
            divModal.innerHTML = data;
            let modal = new bootstrap.Modal(divModal.firstChild);
            setUnsetLoading();
            modal.show();
        }).catch(() => {
            setUnsetLoading();
        });
}

function axiosDelete(button) {
    let url = button.getAttribute('data-url');

    axios.delete(url)
        .then(({data}) => {
            Swal.fire({
                title: data.title,
                text: data.msg,
                icon: data.type,
                confirmButtonText: 'OK'
            });

            if (data.type == 'success') {
                searchRenderTable();
            }

        }).catch(() => {

        });
}

function searchRenderTable(data = '') {
    //TODO: Refactor to not destroy all table, just the content
    let tableBody = document.querySelector('table');
    let table = document.getElementById('table-content');
    let url = document.querySelector('table').getAttribute('data-url');

    axios.get(url, { params: { search: data }})
        .then(({data}) => {
            tableBody.remove();
            table.innerHTML = data;
        }).catch(() => {

        });

}

function setSelect2(select, multiple) {
    $(select).select2({
            theme: "bootstrap-5",
            allowClear: true,
            placeholder: "Selecione",
            closeOnSelect: multiple
        });
}

var behavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
};

options = {
    onKeyPress: function (val, e, field, options) {
        field.mask(behavior.apply({}, arguments), options);
    }
};

function setMask(input, inputClass) {

    if (inputClass == 'cpf') {
        $(input).mask('000.000.000-00');
    }

    if (inputClass == 'cnpj') {
        $(input).mask('00.000.000/0000-00');
    }

    if (inputClass == 'cep') {
        $(input).mask('00000-000');
    }

    if (inputClass == 'phone') {
        $(input).mask(behavior, options);
    }

    if (inputClass == 'money') {
        $(input).mask('R$ 999.999.999,99', {reverse: true});
    }

    if (inputClass == 'date') {
        $(input).mask('00/00/0000');
    }

    if (inputClass == 'cns') {
        $(input).mask('000.0000.0000.0000');
    }
}

function getFormId(button) {
    button.setAttribute('data-form', button.parentElement.parentElement.getAttribute('id'));
}

function submitForm(formId) {

    let form = document.getElementById(formId);

    if (validateForm()) {
        if (form.getAttribute('data-type') == 'submit') {
            setUnsetLoading();
            if (form.getAttribute('data-dependency') === 'true') {
                form.appendChild(document.getElementById('form_inputs'));
                form.submit();
            } else {
                form.submit();
            }
        } else {
            axiosPost(form);
        }
    }
}

function axiosPost(form) {

    setUnsetLoading();
    axios.post(form.getAttribute('data-route'), new FormData(form))
        .then(({data}) => {
            setUnsetLoading();

            if (data.type === 'success') {

                Swal.fire({
                    title: data.title,
                    text: data.msg,
                    icon: data.type,
                    confirmButtonText: 'OK'
                })
                .then(
                    () => {
                        if (form.getAttribute('data-type') == 'redirect') {
                            window.location.href = data.route
                        } else {
                            searchRenderTable();
                            let divModal = document.getElementById('modal');
                            let modal = new bootstrap.Modal(divModal.firstChild);
                            modal.dispose();
                            document.getElementsByClassName('modal-backdrop').remove();
                            // divModal.innerHTML = '';
                        }
                    },
                    () => {}
                );

            } else {
                Swal.fire({
                    title: data.title,
                    text: data.msg,
                    icon: data.type,
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(() => {
            setUnsetLoading();
            Swal.fire({
                title: 'Erro!',
                text: `Ocorreu um erro ao executar a operação. Tente novamente mais tarde ou entre em contato`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
    });
}

function setUnsetLoading() {

    if ($('.div-loading').is(':visible')) {
        $('.div-loading').hide();
    } else {
        $('.div-loading').show();
    }
}

function getCep (text) {

    if (text.length == 9) {
        setUnsetLoading();

        axios.get(`https://viacep.com.br/ws/${text.replace('-', '')}/json/`)
            .then(({data}) => {
                $('#state').val(data.uf).change();
                $('#city').val(data.localidade);
                $('#district').val(data.bairro);
                $('#street').val(data.logradouro);
                $('#type').val(data.logradouro.split(' ')[0]);
                $('#ibge_code').val(data.ibge);

                $('#number').focus();
                setUnsetLoading();
            })
            .catch(() => {
                Swal.fire({
                    title: 'Atenção!',
                    text: 'Insira um CEP válido',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                setUnsetLoading();
            });
    }
};

function validateForm() {

    let valid = true;

    $('.required').each(function () {

        text = $(this).val();
        if (text == '' || text == null || text == undefined) {

            Swal.fire({
                title: 'Atenção!',
                text: `É necessário preencher o campo ${$(this).parent().siblings('label').text()}`,
                icon: 'warning',
                confirmButtonText: 'OK'
            });

            valid = false;
            return false;

        } else {

            text = text.replace(/\s{2,}/g, ' ');
            if (text == '' || text == null || text == undefined) {

                Swal.fire({
                    title: 'Atenção!',
                    text: `É necessário preencher o campo ${$(this).parent().siblings('label').text()}`,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });

                valid = false;
                return false;
            }
        }

        $(this).val(text.replace(/\s{2,}/g, ' '));
    });

    return valid;
}
