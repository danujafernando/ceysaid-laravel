@extends('themes.admin.layouts.admin')
@section('content')
<section id="data-thumb-view" class="data-thumb-view-header">
    <div class="action-btns">
        <a href="{{ route('admin.countries.create')}}" class="btn btn-primary px-1 py-1 waves-effect waves-light">
            Add New
        </a>
    </div>
    <div class="table-responsive">
        <!-- Data list view starts -->
        <table class="table data-thumb-view display dataTable" id="country-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>NAME</th>
                    <th>SLUG</th>
                    <th># Tours</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</section>
<!-- Data list view end -->
<!-- Js start -->
@push('admin-js')
    <script>
        var countryTable = $("#country-table").ceysaidTable({
            processing: true,
            serverSide: true,
            paging: true,
            pageLength: 10,
            url: "{{ route('admin.countries.index')}}",
            columns: [
                {
                    data: "featured_image_url",
                    class: "product-img",
                    render: function (data, type, row) {
                        return "<img src='" + data + "'/>"
                    }
                },
                {
                    data: "name",
                },
                {
                    data: "slug"
                },
                {
                    data: "tours_count"
                },
                {
                    data: "status",
                    render: function (data, type, row) {
                        var className = (data) ? 'chip-success' : 'chip-danger';
                        var text = (data) ? 'Active' : 'Inactive';
                        var html = '<div class="chip ' + className + '">';
                            html += '<div class="chip-body">';
                            html += '<div class="chip-text">' + text + '</div>';
                            html += '</div>';
                            html += '</div>';

                        return html;
                    }
                },
                {
                    data: "id",
                    class: "product-action",
                    render: function (data, type, row) {
                        var url = '{{ route("admin.countries.edit", ":id") }}';
                        url = url.replace(':id', data);
                        var html = '<a href="' + url + '"><span class="action-edit text-primary"><i class="feather icon-edit"></i></span></a>';

                        var postUrl = '{{ route("admin.countries.update", ":id") }}';
                        postUrl = postUrl.replace(':id', data);
                        html += '<form method="POST" action="' + postUrl + '"  style="display: inline">';
                        html += '@csrf';
                        html += '@method("PUT")';
                        html += '<input type="hidden" name="edit_type" value="status" />';

                        if (row.status) {
                            html += '<button class="datatable-button" type="submit"><span class="action-edit text-danger"><i class="feather icon-minus-circle"></i></span></button>';
                        } else {
                            html += '<button class="datatable-button" type="submit"><span class="action-edit text-success"><i class="feather icon-plus-circle"></i></span></button>';
                        }
                        html += '</form>'

                        return html;
                    }
                },
            ]
        });
    </script>
@endpush
<!-- Js end-->
@stop
