async function addDeleteFunctionality() {
	for (const button of allDeleteButtons) {
		button.addEventListener("click", async () => {
			const articleIdToDelete = button.getAttribute("article-id");
			const urlToFetch =
				"https://webik.ms.mff.cuni.cz/~11418120/cms/article-delete/" + articleIdToDelete;
			try {
				const response = await fetch(urlToFetch, { method: "DELETE" });

				if (!response.ok) {
					throw new Error("Error fetching the deletion page.");
				}

				// After requesting that url, I need to update the all articles array
				for (let i = 0; i < allArticles.length; i++) {
					const liElementId = allArticles[i].getAttribute("id");
					const currentId = liElementId.split("-", 2)[1];
					if (currentId == articleIdToDelete) {
						allArticles.splice(i, 1);
						break;
					}
				}

				// Update users view after deletion
				const newPageCount = Math.ceil(allArticles.length / articlesPerPage);
				if (newPageCount != currentPageCount) {
					if (currentPageNumber == currentPageCount) {
						currentPageNumber = currentPageNumber - 1;
					}
					currentPageCount = currentPageCount - 1;
				}
				updatePagingButtonsVisibility();
				displayPageCount();
				displayArticlesOnPage(currentPageNumber);
			} catch (error) {
				console.log("Error deleting an article: " + error);
			}
		});
	}
}
