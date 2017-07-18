# plugin-banner

이 어플리케이션은 Xpressengine3(이하 XE3)의 플러그인입니다.

이 플러그인은 사이트 관리자가 직접 컨텐츠를 편집할 수 있는 배너 위젯을 제공합니다. 
사이트 관리자는 배너 위젯을 하나 생성하고 그 위젯에 출력하고 싶은 다수의 배너 아이템들을 추가하고 편집할 수 있습니다. 생성한 배너 위젯을 테마에 직접 추가하거나 위젯 박스 또는 위젯 페이지에 추가하여 화면에 출력할 수 있습니다.

## Features

- 제공되는 배너 편집기를 통하여 하나의 배너 위젯에 출력할 아이템들을 추가/삭제/편집/순서변경할 수 있습니다.
- 각 아이템에는 제목, 요약, 링크 정보를 지정할 수 있고, 이미지도 업로드할 수 있습니다.
- 각 아이템은 노출여부를 지정할 수 있고, 노출 시작 및 종료 일시를 지정할 수도 있습니다.
- 배너 위젯은 다른 위젯들처럼 테마나 위젯박스에 자유롭게 배치시킬 수 있습니다.
- 화면에 출력되고 있는 배너 위젯의 편집 버튼(사이트관리자에게만 노출됨)을 통해 바로 배너 편집기를 실행시킬 수 있습니다.

## Installation

이 플러그인을 사용하려면 먼저 XE3가 설치돼 있어야 하며, 플러그인을 XE3에 설치를 해야 합니다.

### XE3 자료실을 사용하여 설치

XE3 자료실을 통해 이 플러그인을 설치할 수 있습니다. 자세한 설치 방법은 자료실에서 볼 수 있습니다.

### git clone을 사용하여 설치

1. 설치된 XE3의 `/plugins` 디렉토리에서 아래의 명령을 실행합니다.
	```
	$ git clone https://github.com/xpressengine/plugin-banner.git ./banner
	```
2. 설치된 디렉토리로 이동한 다음, `composer dump`를 실행합니다.
	```
	$ cd ./widget_page
	$ composer dump
	```
3. `사이트관리페이지 > 플러그인 > 플러그인 목록` 페이지에서 'Banner' 플러그인을 활성화합니다.

## Usage

- `사이트관리페이지 > 플러그인 > 플러그인 목록 > Banner` 페이지에서 설정 버튼을 클릭하여 배너 위젯 페이지로 이동합니다.
- 배너 위젯 페이지에서 새 배너 생성을 클릭한 후 상세 정보(제목, 스킨)를 입력한 다음 저장합니다.
- 새로 생성한 배너를 원하는 곳에 배치하기 위하여 테마 편집 페이지에서 위젯 추가를 하거나, 위젯박스에서 위젯을 추가합니다.
- 위젯을 추가할 때 '배너 위젯'을 선택합니다. '배너 선택' 항목에서 새로 생성한 배너를 선택한 후 저장하여 위젯을 배치합니다.
- 배너 위젯이 출력되는 페이지에서 배너 편집 버튼을 클릭하여 배너에서 출력할 컨텐츠(아이템)들을 편집합니다.
