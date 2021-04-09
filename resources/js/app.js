require("./bootstrap");

const deletePostWarning = () => {
    const deleteBtn = document.querySelector(".deleteAssignmentBtn");
    const form = document.querySelector(".deleteForm");

    if (deleteBtn && form) {
        deleteBtn.addEventListener("click", (event) => {
            event.preventDefault();
            if (confirm("Are you sure you want to delete this assignment?")) {
                console.log("Should propogate form submit");
                form.submit();
            }
        });
    }
};
deletePostWarning();
