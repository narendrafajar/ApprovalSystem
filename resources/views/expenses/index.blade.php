<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expenses') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{__('Expenses List')}}</h4>
            <button class="btn btn-primary btn-sm btn-icon" type="button" data-bs-toggle="modal" data-bs-target="#addExpense">
                {{__('Add Expenses')}}
            </button>
        </div>
        <input type="hidden" value="{{$login}}" id="loginId">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2">{{__('ID')}}</th>
                            <th class="text-center" rowspan="2">{{__('Description')}}</th>
                            <th class="text-center" rowspan="2">{{__('Amount')}}</th>
                            <th class="text-center" colspan="3">{{__('Approval Stages')}}</th>
                            <th class="text-center" rowspan="2">{{__('Approval Status')}}</th>
                        </tr>
                        <tr>
                            <th class="text-center">{{__('Ana')}}</th>
                            <th class="text-center">{{__('Ani')}}</th>
                            <th class="text-center">{{__('Ina')}}</th>
                        </tr>
                    </thead>
                    <tbody id="expenses-container">

                    </tbody>
                </table>
            </div>
            {{-- <div id="expenses-container">
                Loading expenses...
            </div> --}}
        </div>
    </div>
    <div class="modal fade" id="addExpense" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('Add Expenses')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-6 col-lg-12 mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Describe the expense">
                            <label for="floatingInput">Description</label>
                          </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <label for="" class="form-label">{{__('Amount (Rp.)')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="text" class="form-control text-right" name="amountExp" id="amountExp" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  onchange="formatRupiah()">
                          </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="storeDataExpese()">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    <script>
        // Menggunakan fetch untuk mengambil data dari API
        window.onload = function () {
            fetch('/api/expenses')
                .then(response => response.json()) // Mengubah response menjadi JSON
                .then(data => {
                    // Loop untuk menambahkan setiap pengeluaran sebagai baris di tabel
                    let loginId = $('#loginId').val();
                    data.data.main.forEach(expense => {
                        // console.log(expense.checkApprovals)
                        let buttonApprove1;
                        let buttonApprove2;
                        let buttonApprove3;
                        let buttonGlobalStatus;
                        if(expense.status1 === 3 && expense.status2 === 3){
                            if(loginId == 1){
                                    buttonApprove1 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                    buttonApprove1 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }

                                if(loginId == 2){
                                    buttonApprove2 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                    buttonApprove2 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }

                                if(loginId == 3){
                                    buttonApprove3 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                   buttonApprove3 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }
                                buttonGlobalStatus = `<button class="btn btn-success btn-sm" disabled> ${expense.currentStatus}</button>`
                        } else {
                            if (expense.approve1 > 0 && expense.approve2 > 0 && expense.approve3 > 0) {
                                if(loginId == 1){
                                    buttonApprove1 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                    buttonApprove1 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }

                                if(loginId == 2){
                                    buttonApprove2 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                    buttonApprove2 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }

                                if(loginId == 3){
                                    buttonApprove2 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                   buttonApprove2 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }
                            } else if (expense.approve1 > 0 && expense.approve2 > 0) {
                                if(loginId == 1){
                                    buttonApprove1 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                    buttonApprove1 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }

                                if(loginId == 2){
                                    buttonApprove2 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                    buttonApprove2 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }

                                if(loginId == 3){
                                    buttonApprove3 = `<button class="btn btn-warning btn-sm" onclick = "submitApprovalStages(${expense.id})"> Lakukan Persetujuan</button>`
                                } else {
                                   buttonApprove3 = `<button class="btn btn-danger btn-sm disabled"> Belum Disetujui</button>`
                                }
                            } else if (expense.approve1 > 0) {
                                if(loginId == 1){
                                    buttonApprove1 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                } else {
                                    buttonApprove1 = `<button class="btn btn-success btn-sm disabled"> Disetujui</button>`
                                }

                                if(loginId == 2){
                                    buttonApprove2 = `<button class="btn btn-warning btn-sm" onclick = "submitApprovalStages(${expense.id})"> Lakukan Persetujuan</button>`;
                                } else {
                                    buttonApprove2 = `<button class="btn btn-danger btn-sm" disabled> Menunggu Persetujuan</button>`;
                                }

                                if(loginId == 3){
                                    buttonApprove3 = `<button class="btn btn-danger btn-sm disabled"> Menunggu Persetujuan</button>`
                                } else {
                                    buttonApprove3 = `<button class="btn btn-danger btn-sm" onclick = "submitApprovalStages(${expense.id})" disabled> Belum Disetujui</button>`
                                }
                            } else {
                                if(loginId == 1){
                                    buttonApprove1 = `<button class="btn btn-warning btn-sm" onclick = "submitApprovalStages(${expense.id})"> Lakukan Persetujuan</button>`
                                } else {
                                     buttonApprove1 = `<button class="btn btn-danger btn-sm" disabled>Menunggu Persetujuan</button>`
                                }

                                if(loginId == 2){
                                    buttonApprove2 = `<button class="btn btn-danger btn-sm disabled"> Menunggu Persetujuan</button>`
                                } else {
                                    buttonApprove2 = `<button class="btn btn-danger btn-sm" disabled> Menunggu Persetujuan</button>`
                                }

                                if(loginId == 3){
                                    buttonApprove3 = `<button class="btn btn-danger btn-sm disabled"> Menunggu Persetujuan</button>`
                                } else {
                                    buttonApprove3 = `<button class="btn btn-danger btn-sm" disabled> Menunggu Persetujuan</button>`
                                }
                            }
                            buttonGlobalStatus = `<button class="btn btn-light btn-sm" disabled> ${expense.currentStatus}</button>`
                        }
                        $('#expenses-container').append(
                            `<tr>`
                                +`<td class="text-center"> ${expense.id} </td>`
                                +`<td> ${expense.description} </td>`
                                +`<td class="text-center"> ${expense.amount} </td>`
                                +`<td class="text-center"> ${buttonApprove1}</td>`                                
                                +`<td class="text-center"> ${buttonApprove2}</td>`                                
                                +`<td class="text-center"> ${buttonApprove3}</td>`                                
                                +`<td class="text-center"> ${buttonGlobalStatus}</td>`                                
                            +`</tr>`
                        )
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('expenses-container').innerHTML = 'Error loading data';
                });
        };

        function formatRupiah(){
            let amount = $('#amountExp').val();
            let formatedChange = parseFloat(amount);
            let amountFormat = formatedChange.toLocaleString('id-ID');

            $('#amountExp').val(amountFormat)
        }

        function storeDataExpese() {
            let desc = $('#floatingInput').val();
            let amountExpense = $('#amountExp').val().replace('.','');
            // console.log(description);
            const data = {
                description : desc,
                amount : parseInt(amountExpense),
                status_id : 1
            }

            fetch('api/expenses/store', {
                method : 'POST',
                headers : {
                    'content-type' : 'application/json',
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                body : JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if(result.success){
                    alert('Expenses Added Successfully');
                    $('#addExpense').modal('hide');
                    location.reload();
                } else {
                    alert('Failed to add expenses :' + result.message);
                }
            })
            .catch(error => {
                console.error('Error :', error);
                alert('Failed to add expenses, Try Again !');
            });
        }

        function submitApprovalStages(expensesId)
        {
            let appId = $('#loginId').val();

            fetch('api/expenses/'+expensesId+'/approve', {
                method : 'PATCH',
                headers : {
                    'content-type' : 'application/json',
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                body : JSON.stringify({ id: expensesId, approver : appId })
            })
            .then(response => {
            if (!response.ok) {
            throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    alert('Expenses updated successfully');
                    location.reload();
                } else {
                    alert('Failed to approve expense: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to approve expense, try again!');
            });
        }
    </script>
</x-app-layout>