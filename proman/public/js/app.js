function liveresults(query) {
  const ul = document.getElementById("results");
  fetch(
    "https://www.cc.puv.fi/~e2101563/proman/controllers/api.php?tasks=1",
    {}
  )
    .then((response) => response.json())
    .then((data) => {
      ul.innerHTML = "";
      let tasks = data.filter((item) => item.Name.includes(query));
      tasks.forEach((element) => {
        const li = document.createElement("li");
        li.innerHTML =
          '<a href="https://www.cc.puv.fi/~e2101563/proman/controllers/task.php?id=' +
          element.ID +
          '">' +
          "Task: " +
          element.Name +
          "</a>";
        ul.appendChild(li);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });

  fetch(
    "https://www.cc.puv.fi/~e2101563/proman/controllers/api.php?projects=1",
    {}
  )
    .then((response) => response.json())
    .then((data) => {
      let projects = data.filter((item) => item.Title.includes(query));
      projects
        .forEach((element) => {
          const li = document.createElement("li");
          li.innerHTML =
            '<a href="https://www.cc.puv.fi/~e2101563/proman/controllers/project.php?id=' +
            element.ID +
            '">' +
            "Project: " +
            element.Title +
            "</a>";
          ul.appendChild(li);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
}
