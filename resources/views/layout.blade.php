<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IF=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Task Manager</title>
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center mb-4">Task Manager</h1>

        <!-- Task Creation Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Create New Task</h5>
            </div>
            <div class="card-body">
                <form id="createTaskForm">
                    <div class="form-group">
                        <label for="title">Task Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Task Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Task Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </form>
            </div>
        </div>

        <!-- Task List -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Task List</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Creation Date</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="taskList">
                        <!-- Tasks will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Editing Task Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm">
                        <input type="hidden" id="editTaskId">
                        <div class="form-group">
                            <label for="editTitle">Task Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Task Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Task Status</label>
                            <select class="form-control" id="editStatus" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Custom JavaScript -->
    <script>
        // Fetching and displaying tasks
        function fetchTasks() {
            fetch('/api/tasks')
                .then(response => response.json())
                .then(data => {
                    const taskList = document.getElementById('taskList');
                    taskList.innerHTML = '';
                    data.forEach(task => {
                        const row = `
                            <tr>
                                <td>${task.title}</td>
                                <td>${new Date(task.created_at).toLocaleDateString()}</td>
                                <td>${task.description || 'N/A'}</td>
                                <td>${task.status}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" onclick="openEditModal(${task.id})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteTask(${task.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                        taskList.innerHTML += row;
                    });
                });
        }

        // Creating a new task
        document.getElementById('createTaskForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('/api/tasks', {
                method: 'POST',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(() => {
                fetchTasks();
                this.reset();
            });
        });

        // Opening edit modal
        function openEditModal(taskId) {
            fetch(`/api/tasks/${taskId}`)
                .then(response => response.json())
                .then(task => {
                    document.getElementById('editTaskId').value = task.id;
                    document.getElementById('editTitle').value = task.title;
                    document.getElementById('editDescription').value = task.description || '';
                    document.getElementById('editStatus').value = task.status;
                    $('#editTaskModal').modal('show');
                });
        }

        // Updating a task
        document.getElementById('editTaskForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const taskId = document.getElementById('editTaskId').value;
            const formData = new FormData(this);
            fetch(`/api/tasks/${taskId}`, {
                method: 'PUT',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(() => {
                fetchTasks();
                $('#editTaskModal').modal('hide');
            });
        });

        // Deleting a task
        function deleteTask(taskId) {
            if (confirm('Are you sure you want to delete this task?')) {
                fetch(`/api/tasks/${taskId}`, {
                    method: 'DELETE'
                })
                .then(() => fetchTasks());
            }
        }

        // Fetching tasks on page load
        fetchTasks();
    </script>

    
</body>
</html>