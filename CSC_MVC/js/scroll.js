let isFetching = false;
let currentPage = 1;
let currentCol = 1;

const usContainer = document.getElementById("usercontainer");
const loader = document.getElementById("loader");

// Functions
const fetchUsers = async () => {
    loader.classList.add("show");
    isFetching = true;
    const response = await fetch(
        "/displayUsers.php?currentpage=" + currentPage
    );
    const users = await response.json();
    updateDom(users);
    currentPage++;
    isFetching = false;
    loader.classList.remove("show");
};

const updateDom = (users) => {
    console.log(users);
    users.forEach((user) => {
        const userContainer  = `
        <div class="card col-3">
                        <div class="card-body">
                            <img class="profile-pic mr-3 img-fluid" src="/CSC_MVC/images/${user._profilePic}" alt="placeholder">
                            <div class="flex-column">
                                <h3 class="mb-0 font-weight-normal"><?php echo $userData->${user._firstName} ${user._lastName}</h3>
                                <a class = "btn btn-primary mt-1" href="profile.php?id=${user._id}">Go To Profile</a>
                            </div>
                        </div>
                    </div>`;
        document.getElementById("scroll").innerHTML += userContainer;
        
    });
};

// // Event Listeners & triggers

// document.addEventListener("DOMContentLoaded", async () => {
//   await fetchImages();
// });

fetchUsers();

window.addEventListener("scroll", async () => {
    // Do not run if currently fetching
    if (isFetching) return;

    // Scrolled to bottom
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        await fetchUsers();
    }
});