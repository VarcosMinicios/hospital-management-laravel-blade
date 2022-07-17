function getPatient(input) {
    if (input.value.length == 14) {
        let url = input.getAttribute('data-url');

        axios.get(url, {params: {"cpf": input.value}})
            .then(({data}) => {
                data = data[0];
                document.getElementById('patient_id').value = data.id;
                document.getElementById('cns').value = data.cns ? data.cns : '';
                document.getElementById('chart').value = data.chart;
                document.getElementById('name').value = data.name;
                document.getElementById('mother_name').value = data.mother_name;
            }).catch(() => {

            });
    }
}

