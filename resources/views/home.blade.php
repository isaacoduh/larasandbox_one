@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex bd-highlight mb-4">
        <div class="p-2 w-100 bd-highlight">
            <h2>Data Management with AJAX</h2>
        </div>
        <div class="p-2 flex-shrink-0 bd-highlight">
            <button class="btn btn-success" id="add-task-btn">Add Task</button>
        </div>
    </div>

    <div>
        <table class="table table-inverse">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Done</th>
                </tr>
            </thead>
            <tbody id="tasks-list" name="tasks-list">
                @foreach ($task as $data)
                    <tr id="task{{$data->id}}">
                        <td>{{$data->id}}</td>
                        <td>{{$data->task}}</td>
                        <td>{{$data->description}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="addTaskFormModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTaskModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                        <form id="addTaskForm" name="addTaskForm" class="form-horizontal" novalidate>
                            <div class="form-group">
                                <label for="">Task</label>
                                <input type="text" class="form-control" id="task" name="task" placeholder="Add Task" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save</button>
                        <input type="hidden" id="task_id" name="task_id" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
