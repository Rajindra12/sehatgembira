<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                Welcome to the user dashboard!
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-lg-8">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Title</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Paweł Kuna</td>
                          <td class="text-secondary">UI Designer, Training</td>
                          <td class="text-secondary"><a href="#" class="text-reset">paweluna@howstuffworks.com</a></td>
                          <td class="text-secondary">User</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>
                        </tr>
                        <tr>
                          <td>Jeffie Lewzey</td>
                          <td class="text-secondary">Chemical Engineer, Support</td>
                          <td class="text-secondary"><a href="#" class="text-reset">jlewzey1@seesaa.net</a></td>
                          <td class="text-secondary">User</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>
                        </tr>
                        <tr>
                          <td>Mallory Hulme</td>
                          <td class="text-secondary">Geologist IV, Support</td>
                          <td class="text-secondary"><a href="#" class="text-reset">mhulme2@domainmarket.com</a></td>
                          <td class="text-secondary">User</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>
                        </tr>
                        <tr>
                          <td>Dunn Slane</td>
                          <td class="text-secondary">Research Nurse, Sales</td>
                          <td class="text-secondary"><a href="#" class="text-reset">dslane3@epa.gov</a></td>
                          <td class="text-secondary">Owner</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>
                        </tr>
                        <tr>
                          <td>Emmy Levet</td>
                          <td class="text-secondary">VP Product Management, Accounting</td>
                          <td class="text-secondary"><a href="#" class="text-reset">elevet4@senate.gov</a></td>
                          <td class="text-secondary">User</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>
                        </tr>
                        <tr>
                          <td>Maryjo Lebarree</td>
                          <td class="text-secondary">Civil Engineer, Product Management</td>
                          <td class="text-secondary"><a href="#" class="text-reset">mlebarree5@unc.edu</a></td>
                          <td class="text-secondary">User</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>
                        </tr>
                        <tr>
                          <td>Egan Poetz</td>
                          <td class="text-secondary">Research Nurse, Engineering</td>
                          <td class="text-secondary"><a href="#" class="text-reset">epoetz6@free.fr</a></td>
                          <td class="text-secondary">Admin</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>
                        </tr>
                        <tr>
                          <td>Kellie Skingley</td>
                          <td class="text-secondary">Teacher, Services</td>
                          <td class="text-secondary"><a href="#" class="text-reset">kskingley7@columbia.edu</a></td>
                          <td class="text-secondary">Owner</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
    </div>
</x-app-layout>