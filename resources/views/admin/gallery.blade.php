<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo technibis.png">
    <title>Technibs</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Bootstrap JS and CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
<style>
    .submenu {
    display: none;
    list-style: none;
    padding-left: 20px;
}

.has-submenu > a {
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.menu-arrow::before {
    content: "\f107"; /* Font Awesome down arrow */
    font-family: FontAwesome;
    font-size: 12px;
    margin-left: 5px;
}

.has-submenu.open > .submenu {
    display: block;
}

.has-submenu.open > a .menu-arrow::before {
    content: "\f106"; /* Font Awesome up arrow */
}

</style>
</head>

<body>
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>   
 
@foreach($galleries as $gallery) 
<!-- Edit Gallery Modal -->
<div class="modal fade" id="editGalleryModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="editGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGalleryModalLabel">Edit Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit Form -->
                <form action="{{ route('admin.updateGallery', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Input to Hold Gallery ID -->
                    <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">

                    <!-- Gallery Title -->
                    <div class="mb-3">
                        <label for="editGalleryTitle{{ $gallery->id }}" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editGalleryTitle{{ $gallery->id }}" name="title" value="{{ $gallery->title }}" required>
                    </div>

                    <!-- Gallery Image -->
                    <div class="mb-3">
                        <label for="editGalleryImage{{ $gallery->id }}" class="form-label">Image</label>
                        <input type="file" class="form-control" id="editGalleryImage{{ $gallery->id }}" name="image">
                    </div>

                    <!-- Gallery Location -->
                    <div class="mb-3">
                        <label for="editGalleryLocation{{ $gallery->id }}" class="form-label">Location</label>
                        <input type="text" class="form-control" id="editGalleryLocation{{ $gallery->id }}" name="location" value="{{ $gallery->location }}" required>
                    </div>

                    <!-- Gallery Category (Dropdown) -->
                    <div class="mb-3">
                        <label for="editGalleryCategory{{ $gallery->id }}" class="form-label">Category</label>
                        <select class="form-control" name="category" required>
                        @foreach($categories as $category)
            <option value="{{ $category->name}}" 
                {{ $gallery->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Gallery</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Gallery Modal -->
<div class="modal fade" id="deleteGalleryModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="deleteGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGalleryModalLabel">Delete Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this gallery item?</p>
                <!-- Hidden Input to Hold Gallery ID for Deletion -->
                <form action="{{ route('admin.deleteGallery', $gallery->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <!-- Submit Button for Deletion -->
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach

 <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="/admin" class="logo">
					<img src="assets/img/logo technibis.png" width="35" height="35" alt=""> <span>Technibs</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            
            
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="/admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fa fa-home"></i> <span>Home Page</span> <span class="menu-arrow"></span></a>
                            <ul class="submenu">
                                <li><a href="/adminexpertise">Expertise in Action</a></li>
                                <li><a href="/adminclients">Clients</a></li>
                                <li><a href="/adminabout">About</a></li>
                                <li><a href="/adminofferings">Services</a></li>
                               
                            </ul>
                        </li>
                       
                        <li>
                            <a href="/adminservices-page"><i class="fa fa-money"></i> <span>Service Page</span></a>
                        </li>
                        <li class="has-submenu">
    <a href="#"><i class="fa fa-briefcase"></i> <span>Projects</span> <span class="menu-arrow"></span></a>
    <ul class="submenu">
        @foreach($categories as $category)
            <li><a href="{{ route('admin.projects.category', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
        @endforeach
        
    </ul>
</li>
                        
                        
                        <li class="active">
                            <a href="/admingallery"><i class="fa fa-image"></i> <span>Gallery</span></a>
                        </li>
                        <li>
                            <a href="/admintestimonials"><i class="fa fa-commenting-o"></i> <span>Testimonials</span></a>
                        </li>
                      
                        <li>
                            <a href="/admincontact"><i class="fa fa-book"></i> <span>Contact Messages</span></a>
                        </li>
                    </ul>                    
                </div>
            </div>
        </div>
          
        <div class="page-wrapper">
    <div class="content">
    <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                    <!-- Delete Button -->
                    <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Form to Add New Category -->
        <form action="{{ route('admin.storeCategory') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter new category" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Category</button>
        </form>

      



                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Gallery</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
    <a href="#" class="btn btn-primary btn-rounded float-right" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
        <i class="fa fa-plus"></i> Add Gallery
    </a>
</div>

                </div>
                <!-- <div class="mb-3 text-right">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
                <i class="fa fa-plus"></i> Add Gallery
            </button>
        </div> -->

        <!-- Gallery Items -->
        <div class="row">
            @foreach($galleries as $gallery)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" class="card-img-top" alt="{{ $gallery->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->title }}</h5>
                            <p class="card-text">Location: {{ $gallery->location }}</p>
                            <p class="card-text">Category: {{ $gallery->category }}</p>
                            <!-- Edit Button -->
<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editGalleryModal{{ $gallery->id }}">Edit</button>

<!-- Delete Button -->
<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteGalleryModal{{ $gallery->id }}">Delete</button>

                           
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add Gallery Modal -->
    <div class="modal fade" id="addGalleryModal" tabindex="-1" aria-labelledby="addGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGalleryModalLabel">Add New Gallery Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.storeGallery') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Gallery</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
           
                
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/plugins/light-gallery/js/lightgallery-all.min.js"></script>
    <script src="assets/js/app.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
</body>


<!-- gallery24:04-->
</html>