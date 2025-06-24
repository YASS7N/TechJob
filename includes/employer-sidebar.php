<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="../css/sidebar.css">

<aside class="col-lg-3 mb-4">
  <div class="card">
    <div class="card-body">
      <div class="nav flex-column nav-pills" id="employer-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active mb-2"
                id="post-job-tab"
                data-bs-toggle="pill"
                data-bs-target="#post-job"
                type="button"
                role="tab"
                aria-controls="post-job"
                aria-selected="true">
          <i class="fas fa-plus"></i> Publier une offre
        </button>

        <button class="nav-link mb-2"
                id="applicants-tab"
                data-bs-toggle="pill"
                data-bs-target="#applicants"
                type="button"
                role="tab"
                aria-controls="applicants"
                aria-selected="false">
          <i class="fas fa-user-friends"></i> Candidats
        </button>

        <button class="nav-link mb-2"
                id="active-jobs-tab"
                data-bs-toggle="pill"
                data-bs-target="#active-jobs"
                type="button"
                role="tab"
                aria-controls="active-jobs"
                aria-selected="false">
          <i class="fas fa-briefcase"></i> Offres actives
        </button>

        <button class="nav-link mb-2"
                id="all-jobs-tab"
                data-bs-toggle="pill"
                data-bs-target="#all-jobs"
                type="button"
                role="tab"
                aria-controls="all-jobs"
                aria-selected="false">
          <i class="fas fa-eye"></i> Toutes les offres
        </button>
      </div>
    </div>
  </div>
</aside>
