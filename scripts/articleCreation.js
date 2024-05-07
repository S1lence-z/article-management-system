const saveButton = document.getElementById("save-button");
const newNameInput = document.getElementById("new-name-input");

// Create article button is disabled when there is no name
saveButton.disabled = true;
newNameInput.addEventListener("input", () => {
	if (newNameInput.value == "") {
		saveButton.disabled = true;
	} else {
		saveButton.disabled = false;
	}
});

// Display pop up window with article creation
const windowForCreatingArticle = document.getElementById("create-article-window");
const createArticleButton = document.getElementById("create-article-button");
createArticleButton.addEventListener("click", () => {
	windowForCreatingArticle.classList.remove("hidden");
});

// Stop displaying pop up window with article creation
const cancelButton = document.getElementById("cancel-button");
cancelButton.addEventListener("click", () => {
	windowForCreatingArticle.classList.add("hidden");
});
