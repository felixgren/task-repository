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

const deleteFileUploaded = async () => {
    const deleteBtns = document.querySelectorAll(".deleteFileBtn");

    deleteBtns?.forEach((elem) => {
        const id = elem.dataset.id;
        elem.addEventListener("click", async (e) => {
            e.preventDefault();
            const res = await fetch(
                `http://localhost:3000/api/assignment/10/delete/${id}`
            );
            const { deleted } = await res.json();

            if (deleted) {
                elem.parentElement.remove();
            }
        });
    });
};

deleteFileUploaded();
