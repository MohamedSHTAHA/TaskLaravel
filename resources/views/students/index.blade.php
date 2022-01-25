<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- datatable --}}


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Students</h2>
        <div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" id="data-table-search" class="form-control" autofocus placeholder="search">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-success"><a href="{{ route('students.create') }}"> Add Student
                            </a></button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-success"><a href="{{ url('students.xlsx') }}">Import Example
                            </a></button>
                    </div>
                </div>
                <div class="col-md-12">
                    <form action="{{ route('students.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <label>Select File to Upload <small
                                    class="warning text-muted">{{ __('Please upload only Excel (.xlsx or .xls) files') }}</small></label>
                            <div class="input-group">
                                <input type="file" required class="form-control" name="uploaded_file"
                                    id="uploaded_file">
                                @if ($errors->has('uploaded_file'))
                                    <p class="text-right mb-0">
                                        <small class="danger text-muted"
                                            id="file-error">{{ $errors->first('uploaded_file') }}</small>
                                    </p>
                                @endif
                                <div class="input-group-append" id="button-addon2">
                                    <button class="btn btn-primary square" type="submit"><i class="ft-upload mr-1"></i>
                                        Upload</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-12">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered" id="students-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>F Name</th>
                                    <th>S Name</th>
                                    <th>T Name</th>
                                    <th>L Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                        </table>

                    </div><!-- end of table responsive -->

                </div><!-- end of col -->

            </div><!-- end of row -->


        </div><!-- end of col -->


    </div>

    <script>
        let rolesTable = $('#students-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,

            ajax: {
                url: '{{ route('students.data') }}',
            },

            columns: [{
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'second_name',
                    name: 'second_name'
                },
                {
                    data: 'third_name',
                    name: 'third_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false
                }

            ],
            order: [
                [0, 'desc']
            ],

        });

        $('#data-table-search').keyup(function() {
            rolesTable.search(this.value).draw();
        })
    </script>
</body>

</html>
