document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-btn");
    const editModal = new bootstrap.Modal(document.getElementById("editModal"));
    const editUserForm = document.getElementById("editUserForm");

    editButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const id = button.getAttribute("data-id");
            const name = button.getAttribute("data-name");
            const username = button.getAttribute("data-username");
            const email = button.getAttribute("data-email");
            const role = button.getAttribute("data-role");

            document.getElementById("edit-id").value = id;
            document.getElementById("edit-name").value = name;
            document.getElementById("edit-username").value = username;
            document.getElementById("edit-email").value = email;
            document.getElementById("edit-role").value = role;

            editModal.show();
        });
    });

    editUserForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const id = document.getElementById("edit-id").value;
        const url = `/admin/pengguna/update/${id}`;
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        const data = {
            name: document.getElementById("edit-name").value,
            username: document.getElementById("edit-username").value,
            email: document.getElementById("edit-email").value,
            role: document.getElementById("edit-role").value,
        };

        fetch(url, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                Accept: "application/json",
            },
            body: JSON.stringify(data),
        })
            .then((response) => {
                if (response.ok) {
                    location.reload();
                } else {
                    return response.json().then((data) => {
                        alert(
                            "Error: " +
                                (data.message || "Failed to update user")
                        );
                    });
                }
            })
            .catch((error) => {
                alert("Error: " + error.message);
            });
    });
});
