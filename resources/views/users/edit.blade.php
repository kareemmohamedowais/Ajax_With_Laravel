<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>User Registration</h2>
        <form>
            <!-- Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>

            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password">
            </div>

            <!-- Governorate Select Box -->
            <div class="mb-3">
                <label for="governorate" class="form-label">Governorate</label>
                <select class="form-select" id="governorate">
                    <option selected>Select Governorate</option>
                    <option value="1">Governorate 1</option>
                    <option value="2">Governorate 2</option>
                    <option value="3">Governorate 3</option>
                </select>
            </div>

            <!-- City Select Box -->
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select class="form-select" id="city">
                    <option selected>Select City</option>
                    <option value="1">City 1</option>
                    <option value="2">City 2</option>
                    <option value="3">City 3</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
