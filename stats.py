from datetime import datetime
from json import load
from math import ceil

import matplotlib.pyplot as plt
from matplotlib.dates import DateFormatter

# JSON Dump: SELECT * ... > Export JSON
comments = load(open("dumps/Season 2/2026-11-05.json"))

# Parse date fields
for i in range(len(comments)):
    comments[i]["data"] = datetime.strptime(comments[i]["data"], "%Y-%m-%d %H:%M:%S")

# Get comment history
total_weeks = ceil((comments[-1]["data"] - comments[0]["data"]).days / 7)
comments_history = {
    "x": [],
    "y": [],
}

total = 0
for comment in comments:
    total += 1

    if comment["data"] < comments[0]["data"]:
        continue

    comments_history["x"].append(comment["data"])
    comments_history["y"].append(total)

print(f"Всего недель: {total_weeks}")
print(f"Всего комментариев: {total:,}")
print(f"Последний id: {comments[-1]["id"]:,}")

# Plots
fig, axs = plt.subplot_mosaic(
    [["comments"], ["activity"]],
    figsize=(12.5, 7.5),
)

fig.canvas.manager.set_window_title("Статистика Demoscene")
ax = list(axs.items())

# Comments
ax[0][1].set_title("Число комментариев", loc="left")
ax[0][1].plot(
    comments_history["x"], comments_history["y"], color="tab:purple", linewidth=3
)
ax[0][1].xaxis.set_major_formatter(DateFormatter("%d.%m.%Y"))
ax[0][1].set_xlim(comments_history["x"][0], comments_history["x"][-1])
ax[0][1].set_ylim(0, total + 500)

# Activity
ax[1][1].set_title("Активность по неделям", loc="left")
ax[1][1].hist(comments_history["x"], bins=total_weeks, color="tab:purple")
ax[1][1].xaxis.set_major_formatter(DateFormatter("%d.%m.%Y"))
ax[1][1].set_xlim(comments_history["x"][0], comments_history["x"][-1])
ax[1][1].set_ylim([1, 10**4])
ax[1][1].set_yscale("log")

plt.tight_layout()
plt.show()
