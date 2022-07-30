<x-commons.backbutton>
    @slot('message', 'Lista de asignaturas')
    @slot('redirect', route('dashboard'))
    @if (auth()->user()->is_administrator && !$subject->is_approved)
        <button type="button" data-toggle="modal" data-target="#modalApproveSubject"
            class="btn btn-outline-success btn-sm shadow-sm mb-3 {{ $subject->certificates()->exists() ? '' : 'disabled' }}">
            aprobar asignatura
        </button>
        <x-modals.approve-subject :subject="$subject"></x-modals.approve-subject>
    @endif
</x-commons.backbutton>

<ul class="nav nav-tabs mb-5">
    <li class="nav-item">
        <a class="nav-link {{ $activeSection == 'teachers' ? 'active text-success' : 'text-primary' }} "
            aria-current="page" href="{{ route('subjects.teachers.show', [$subject]) }}">
            <i class="fas fa-solid fa-school"></i>
            Autores y/o Revisores
            @if ($subject->isTeacherModuleCompleted())
                <small><i class="ml-1 fas fa-check-circle"></i></small>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeSection == 'contents' ? 'active text-success' : 'text-primary' }} "
            aria-current="page" href="{{ route('subjects.contents.show', [$subject]) }}">
            <i class="fas fa-solid fa-box"></i>
            Contenidos Temáticos
            @if ($subject->isContentModuleCompleted())
                <small><i class="ml-1 fas fa-check-circle"></i></small>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeSection == 'general-information' ? 'active text-success' : 'text-primary' }}"
            href="{{ route('subjects.general-information.show', [$subject]) }}">
            <i class="fas fa-solid fa-info mr-2"></i>
            Estrategias, Recursos y Ejes
            @if ($subject->isGeneralInformationModuleCompleted())
                <small><i class="ml-1 fas fa-check-circle"></i></small>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeSection == 'validation-certificate' ? 'active text-success' : 'text-primary' }}"
            href="{{ route('subjects.validation-certificates.show', [$subject]) }}" tabindex="-1"
            aria-disabled="true">
            <i class="fas fa-solid fa-file-contract mr-2"></i>
            Acta de aprobación
            @if ($subject->isCertificateModuleCompleted())
                <small><i class="ml-1 fas fa-check-circle"></i></small>
            @endif
        </a>
    </li>
</ul>
